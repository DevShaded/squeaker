<script setup lang="ts">
import { defineProps, reactive, ref } from "vue";
import { Post } from "../../types/Post";
import { Link } from "@inertiajs/vue3";
import { ChatBubbleLeftEllipsisIcon, HandThumbUpIcon, ShareIcon } from "@heroicons/vue/20/solid";
import { getAvatar } from "../../utils/getAvatar";

const props = defineProps<{
    data: object
}>()

const post = reactive<Post>(props.data)

const hasLiked = ref<boolean>(post.has_liked)

function handleLike() {
    hasLiked.value = !hasLiked.value

    if (hasLiked.value) {
        return post.likes++
    } else {
        return post.likes--
    }
}

const avatar = ref(getAvatar(post.user.avatar));
const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp)
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}
</script>

<template>
    <article :aria-labelledby="'question-title-' + post.id" class="bg-white mx-4 my-6 px-4 py-6 shadow sm:rounded-lg sm:p-6">
        <div class="flex space-x-3">
            <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" :src="avatar" :alt="post.user.name" />
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
                    <button class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
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
</template>

<style scoped>

</style>
