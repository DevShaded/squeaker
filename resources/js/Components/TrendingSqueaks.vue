<script setup lang="ts">
import { defineProps } from 'vue'
import {ChatBubbleLeftEllipsisIcon} from "@heroicons/vue/20/solid";
import {Link} from "@inertiajs/vue3";
import { TrendingPosts } from "../types/TrendingPosts";

defineProps<{
    trendingSqueaks: TrendingPosts[]
}>()
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
    <section aria-labelledby="trending-heading">
        <div class="rounded-lg bg-white shadow">
            <div class="p-6">
                <h2 id="trending-heading" class="text-base font-medium text-gray-900">Trending</h2>
                <div class="mt-6 flow-root">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        <li v-for="post in trendingSqueaks" :key="post.id" class="flex space-x-3 py-4">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" :src="post.user.avatar" :alt="post.user.name" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-sm font-medium text-gray-900">
                                    <Link :href="'/user/' + post.user.name">{{ post.user.name }}</Link>
                                </h3>
                                <!-- created at -->
                                <p class="text-sm text-gray-500">
                                    <time>{{ timestampToDate(post.created_at) }}</time>
                                </p>
                                <Link :href="'/squeak/' + post.id">
                                    <p class="text-sm text-gray-800">{{ post.content }}</p>
                                </Link>
                                <div class="mt-2 flex">
                                <span class="inline-flex items-center text-sm">
                                  <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                    <ChatBubbleLeftEllipsisIcon class="h-5 w-5" aria-hidden="true" />
                                    <span class="font-medium text-gray-900">{{ formatNumber(post.comments_count, 0) }}</span>
                                  </button>
                                </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>
