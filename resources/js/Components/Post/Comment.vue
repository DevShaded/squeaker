<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import { CommentsEntity } from "../../types/Post";
import { computed, ref } from "vue";
import PrimaryButton from "../PrimaryButton.vue";
import CreateReplyForm from "../../Pages/Post/Partials/CreateReplyForm.vue";
import { getAvatar } from "../../utils/getAvatar";

const props = defineProps<{
    comment: CommentsEntity
}>()

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp)
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}

const page = usePage()
const user = computed(() => page.props.auth.user)

const avatar = ref(getAvatar(props.comment.user[0].avatar));
</script>

<template>
    <div class="bg-white mx-4 my-6 px-4 py-6 shadow sm:rounded-lg sm:p-6">
        <div class="flex space-x-3">
            <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" :src="avatar" :alt="comment.user[0].name" />
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
            <PopoverButton>
                <PrimaryButton>Reply</PrimaryButton>
            </PopoverButton>

            <PopoverPanel class="absolute z-10 bg-white w-full">
                <CreateReplyForm :comment="comment" />
            </PopoverPanel>
        </Popover>
    </div>
</template>

<style scoped>

</style>
