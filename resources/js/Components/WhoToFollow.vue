<script setup lang="ts">
import {PlusIcon} from "@heroicons/vue/20/solid";
import {defineProps} from "vue";

defineProps<{
    whoToFollow: {
        name: string,
        handle: string,
        imageUrl: string,
        href: string,
    }[]
}>()
</script>

<template>
    <section aria-labelledby="who-to-follow-heading">
        <div class="rounded-lg bg-white shadow">
            <div class="p-6">
                <h2 id="who-to-follow-heading" class="text-base font-medium text-gray-900">Who to follow</h2>
                <div class="mt-6 flow-root">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        <li v-for="user in whoToFollow" :key="user.handle" class="flex items-center space-x-3 py-4">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    <a :href="user.href">{{ user.name }}</a>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <a :href="user.href">{{ '@' + user.handle }}</a>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="inline-flex items-center gap-x-1.5 text-sm font-semibold leading-6 text-gray-900">
                                    <PlusIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    Follow
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mt-6">
                    <a href="#" class="block w-full rounded-md bg-white px-3 py-2 text-center text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">View all</a>
                </div>
            </div>
        </div>
    </section>
</template>
