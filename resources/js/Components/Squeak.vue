<script setup lang="ts">
import { defineProps, ref } from 'vue'
import { ChatBubbleLeftEllipsisIcon, HandThumbUpIcon, ShareIcon, } from "@heroicons/vue/20/solid";
import {Link} from "@inertiajs/vue3";
import { Post } from '../types/Post'

const props = defineProps<{
    squeak: Post
}>()

const hasLiked = ref<boolean>(props.squeak.has_liked)

function handleLike() {
    hasLiked.value = !hasLiked.value

    if (hasLiked.value) {
        return props.squeak.likes++
    } else {
        return props.squeak.likes--
    }
}

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp)
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}

function formatNumber(number: number = 0, dec: number): string | undefined {
    if (isNaN(number)) {
        number = 0
    }
    switch (dec) {
        case 0:
            return number.toLocaleString('en-US', { maximumFractionDigits: 0, minimumFractionDigits: 0 })
        case 1:
            return number.toLocaleString('en-US', { maximumFractionDigits: 1, minimumFractionDigits: 1 })
        case 2:
            return number.toLocaleString('en-US', { maximumFractionDigits: 2, minimumFractionDigits: 2 })
    }
}
</script>

<template>
    <div>
        <article :aria-labelledby="'question-title-' + props.squeak.id">
            <div class="flex space-x-3">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" :src="props.squeak.user.avatar" :alt="props.squeak.user.name" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900">
                        <Link :href="'/user/' + props.squeak.user.name" class="hover:underline">{{ props.squeak.user.name }}</Link>
                    </p>
                    <p class="text-sm text-gray-500">
                        <time class="hover:underline" :datetime="timestampToDate(props.squeak.created_at)">{{ timestampToDate(props.squeak.created_at) }}</time>
                    </p>
                </div>
            </div>
            <Link :href="'/squeak/' + props.squeak.id">
                <div class="mt-4 space-y-4 text-sm text-gray-700">
                    {{ props.squeak.content }}
                </div>
            </Link>
            <div class="mt-6 flex justify-between space-x-8">
                <div class="flex space-x-6">
                    <span class="inline-flex items-center text-sm">
                        <Link :href="!hasLiked ? '/squeak/' + props.squeak.id + '/like' : '/squeak/' + props.squeak.id + '/unlike'" method="post" as="button" type="button" @click="handleLike" class="inline-flex space-x-2" :class="!hasLiked ? 'text-gray-400 hover:text-gray-500' : 'text-indigo-400 hover:text-indigo-500'">
                            <HandThumbUpIcon class="h-5 w-5" aria-hidden="true" />
                            <span class="font-medium text-gray-900">{{ props.squeak.likes }}</span>
                            <span class="sr-only">likes</span>
                        </Link>
                    </span>
                    <span class="inline-flex items-center text-sm">
                        <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                            <ChatBubbleLeftEllipsisIcon class="h-5 w-5" aria-hidden="true" />
                            <span class="font-medium text-gray-900">{{ props.squeak.comments_count }}</span>
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
    </div>
</template>
