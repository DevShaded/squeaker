<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { defineProps, ref, reactive, computed } from "vue";
import { Post } from "../../types/Post";
import { ChatBubbleLeftEllipsisIcon, HandThumbUpIcon, ShareIcon } from "@heroicons/vue/20/solid";
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";

const props = defineProps<{
    data: object
}>()

const post = reactive<Post>(props.data.data)

const hasLiked = ref<boolean>(post.has_liked)

function handleLike() {
    hasLiked.value = !hasLiked.value

    if (hasLiked.value) {
        return post.likes++
    } else {
        return post.likes--
    }
}

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp)
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}

const page = usePage()
const user = computed(() => page.props.auth.user)

const form = useForm({
    content: null,
    post_id: post.id,
    user_id: user.value.id,
})

const replyForm = useForm({
    content: null,
    comment_id: post.id,
    user_id: user.value.id,
})

function submit() {
    router.post('/squeak/' + post.id + '/comment', form, {
        preserveScroll: true,
        preserveState: false,
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto">
            <article :aria-labelledby="'question-title-' + post.id" class="bg-white mx-4 my-6 px-4 py-6 shadow sm:rounded-lg sm:p-6">
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="post.user.avatar" :alt="post.user.name" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900">
                            <Link :href="'/user/' + post.user.name" class="hover:underline">{{ post.user.name }}</Link>
                        </p>
                        <p class="text-sm text-gray-500">
                            <time class="hover:underline" :datetime="timestampToDate(post.created_at)">{{ timestampToDate(post.created_at) }}</time>
                        </p>
                    </div>
                </div>
                <div class="mt-4 space-y-4 text-sm text-gray-700">
                    {{ post.content }}
                </div>
                <div class="mt-6 flex justify-between space-x-8">
                    <div class="flex space-x-6">
                    <span class="inline-flex items-center text-sm">
                        <Link :href="!hasLiked ? '/squeak/' + post.id + '/like' : '/squeak/' + post.id + '/unlike'" method="post" as="button" type="button" @click="handleLike" class="inline-flex space-x-2" :class="!hasLiked ? 'text-gray-400 hover:text-gray-500' : 'text-indigo-400 hover:text-indigo-500'">
                            <HandThumbUpIcon class="h-5 w-5" aria-hidden="true" />
                            <span class="font-medium text-gray-900">{{ post.likes }}</span>
                            <span class="sr-only">likes</span>
                        </Link>
                    </span>
                        <span class="inline-flex items-center text-sm">
                        <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                            <ChatBubbleLeftEllipsisIcon class="h-5 w-5" aria-hidden="true" />
                            <span class="font-medium text-gray-900">{{ post.comments_count }}</span>
                            <span class="sr-only">replies</span>
                        </button>
                    </span>
                    </div>
                    <div class="flex text-sm">
                    <span class="inline-flex items-center text-sm">
                        <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                            <ShareIcon class="h-5 w-5" aria-hidden="true" />
                            <span class="font-medium text-gray-900">Share</span>
                        </button>
                    </span>
                    </div>
                </div>
            </article>

            <div class="mx-4">
                <span>Comments: {{ post.comments_count }}</span>

                <div class="my-3 bg-white">
                    <div class="flex items-start space-x-4">
                        <div class="min-w-0 flex-1">
                            <form @submit.prevent="submit" class="relative">
                                <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                    <label for="comment" class="sr-only">Add your comment</label>
                                    <textarea rows="3" name="comment" id="comment" required v-model="form.content" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Add your comment..." />

                                    <!-- Spacer element to match the height of the toolbar -->
                                    <div class="py-2" aria-hidden="true">
                                        <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                        <div class="py-px">
                                            <div class="h-9" />
                                        </div>
                                    </div>
                                </div>

                                <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                                    <div class="flex-shrink-0">
                                        <button :disabled="form.processing" type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="post.comments.length">
                <div v-for="comment in post.comments" :key="comment.id">
                    <div class="bg-white mx-4 my-6 px-4 py-6 shadow sm:rounded-lg sm:p-6">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="comment.user[0].avatar" :alt="comment.user[0].name" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    <Link :href="'/user/' + comment.user[0].name" class="hover:underline">{{ comment.user[0].name }}</Link>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <time class="hover:underline" :datetime="timestampToDate(comment.created_at)">{{ timestampToDate(comment.created_at) }}</time>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 space-y-4 text-sm text-gray-700">
                            {{ comment.content }}
                        </div>

                        <Popover class="relative pt-5 flex justify-end">
                            <PopoverButton class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reply</PopoverButton>

                            <PopoverPanel class="absolute z-10 bg-white w-full">
                                <form @submit.prevent="router.post('/squeak/' + comment.id + '/reply', { content: replyForm.content, comment_id: comment.id, user_id: user.id, }, { preserveScroll: true, preserveState: false })" class="relative">
                                    <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                        <label for="comment" class="sr-only">Add your comment</label>
                                        <textarea rows="3" name="comment" id="comment" required v-model="replyForm.content" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Add your comment..." />

                                        <!-- Spacer element to match the height of the toolbar -->
                                        <div class="py-2" aria-hidden="true">
                                            <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                            <div class="py-px">
                                                <div class="h-9" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                                        <div class="flex-shrink-0">
                                            <button type="submit" :disabled="form.processing" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                                        </div>
                                    </div>
                                </form>
                            </PopoverPanel>
                        </Popover>
                    </div>

                    <div v-for="reply in comment.replies" :key="reply.id">
                        <div class="bg-white p-4 ml-12 mr-4 my-6 flex overflow-hidden shadow sm:rounded-lg sm:p-6">
                            <div class="mr-4 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="reply.user.avatar" :alt="reply.user.name" />
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    <Link :href="'/' + reply.user.id" class="hover:underline">{{ reply.user.name }}</Link>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <time class="hover:underline" :datetime="timestampToDate(reply.created_at)">{{ timestampToDate(reply.created_at) }}</time>
                                </p>
                                <p class="mt-1 space-y-4 text-sm text-gray-700">{{ reply.content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
