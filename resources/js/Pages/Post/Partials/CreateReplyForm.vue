<script setup lang="ts">
import { router, useForm, usePage } from "@inertiajs/vue3";
import InputLabel from "../../../Components/InputLabel.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import TextAreaInput from "../../../Components/TextAreaInput.vue";
import { CommentsEntity } from "../../../types/Post";
import { computed } from "vue";

const props = defineProps<{
    comment: CommentsEntity
}>()

const page = usePage()
const user = computed(() => page.props.auth.user)

const form = useForm({
    content: null,
    post_id: props.comment.post.id,
    user_id: user.value.id,
})

const replyForm = useForm({
    content: null,
    comment_id: props.comment.post.id,
    user_id: user.value.id,
})

function submit() {
    router.post('/squeak/' + props.comment.post.id + '/comment', form, {
        preserveScroll: true,
        preserveState: false,
    })
}
</script>

<template>
    <form @submit.prevent="router.post('/squeak/' + comment.id + '/reply', { content: replyForm.content, comment_id: comment.id, user_id: user.id, }, { preserveScroll: true, preserveState: false })" class="relative">
        <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
            <InputLabel for="reply" class="sr-only" value="Reply to a comment" />

            <TextAreaInput
                rows="3"
                name="reply"
                id="reply"
                required
                v-model="replyForm.content"
                class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                placeholder="Add your reply..." />

            <!-- Spacer element to match the height of the toolbar -->
            <div class="py-2" aria-hidden="true">
                <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                <div class="py-px">
                    <div class="h-9" />
                </div>
            </div>

            <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                <div class="flex-shrink-0">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Post
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
