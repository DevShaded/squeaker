<script setup lang="ts">
import { defineProps } from 'vue'
import {ChatBubbleLeftEllipsisIcon} from "@heroicons/vue/20/solid";
import {Link} from "@inertiajs/vue3";

defineProps<{
    trendingSqueaks: {
        id: number,
        user: {
            name: string,
            imageUrl: string,
        },
        body: string,
        comments: number,
    }[]
}>()
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
                                <img class="h-8 w-8 rounded-full" :src="post.user.imageUrl" :alt="post.user.name" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-gray-800">{{ post.body }}</p>
                                <div class="mt-2 flex">
                                <span class="inline-flex items-center text-sm">
                                  <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                    <ChatBubbleLeftEllipsisIcon class="h-5 w-5" aria-hidden="true" />
                                    <span class="font-medium text-gray-900">{{ post.comments }}</span>
                                  </button>
                                </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mt-6">
                    <Link href="#" class="block w-full rounded-md bg-white px-3 py-2 text-center text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">View all</Link>
                </div>
            </div>
        </div>
    </section>
</template>
