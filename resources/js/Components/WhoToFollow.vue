<script setup lang="ts">
import {PlusIcon} from "@heroicons/vue/20/solid";
import {defineProps} from "vue";
import { WhoToFollowType } from "../types/WhoToFollow";
import { Link } from "@inertiajs/vue3";

defineProps<{
    whoToFollow: WhoToFollowType[]
}>()
</script>

<template>
    <section aria-labelledby="who-to-follow-heading">
        <div class="rounded-lg bg-white shadow">
            <div class="p-6">
                <h2 id="who-to-follow-heading" class="text-base font-medium text-gray-900">Who to follow</h2>
                <div class="mt-6 flow-root">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        <li v-for="user in whoToFollow" :key="user.id" class="flex items-center space-x-3 py-4">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" :src="user.avatar" alt="" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    <Link :href="'/user/' + user.name">{{ user.name }}</Link>
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
            </div>
        </div>
    </section>
</template>
