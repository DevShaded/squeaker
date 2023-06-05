<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { RepliesEntity } from "../../types/Post";

defineProps<{
    reply: RepliesEntity
}>()

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp)
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}
</script>

<template>
    <div class="bg-white p-4 ml-12 mr-4 my-6 flex overflow-hidden shadow sm:rounded-lg sm:p-6">
        <div class="mr-4 flex-shrink-0">
            <img class="h-10 w-10 rounded-full" :src="reply.user?.avatar" :alt="reply.user?.name" />
        </div>
        <div>
            <p class="text-sm font-medium text-gray-900">
                <Link :href="'/' + reply.user?.id" class="hover:underline">{{ reply.user.name }}</Link>
            </p>
            <p class="text-sm text-gray-500">
                <time class="hover:underline" :datetime="timestampToDate(reply.created_at)">{{ timestampToDate(reply.created_at) }}</time>
            </p>
            <p class="mt-1 space-y-4 text-sm text-gray-700">{{ reply.content }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
