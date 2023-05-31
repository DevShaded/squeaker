<script setup lang="ts">
import { defineProps, ref } from "vue";
import { WhoToFollowType } from "../types/WhoToFollow";
import { Link } from "@inertiajs/vue3";
import { UserMinusIcon, UserPlusIcon } from "@heroicons/vue/24/solid";

const props = defineProps<{
    whoToFollow: WhoToFollowType
}>();

// check if user is following or not for each user
const checkIfFollowing = (item: object) => {
    return item.is_following
}

const handleFollow = (item: object) => {
    let isFollowing = ref<boolean>(item.is_following)

    isFollowing.value = !isFollowing.value
}
</script>

<template>
    <section aria-labelledby="who-to-follow-heading">
        <div class="rounded-lg bg-white shadow">
            <div class="p-6">
                <h2 id="who-to-follow-heading" class="text-base font-medium text-gray-900">Who to follow</h2>
                <p class="text-xs pt-2 text-gray-500">List will update if you refresh the webpage!</p>
                <div class="mt-6 flow-root">
                    <ul role="list" class="-my-4 divide-y divide-gray-200">
                        <li v-for="user in props.whoToFollow.data" :key="user.id" class="flex items-center space-x-3 py-4">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" :src="user.avatar" alt="" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    <Link :href="'/user/' + user.name">{{ user.name }}</Link>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <!-- it works -->
                                <Link :href="!checkIfFollowing(user) ? '/follow/' + user.id : '/unfollow/' + user.id" @click="handleFollow" method="post" as="button" type="button" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <UserPlusIcon v-if="!checkIfFollowing(user)" class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                    <UserMinusIcon v-if="checkIfFollowing(user)" class="-ml-0.5 h-5 w-5 text-red-500" aria-hidden="true" />
                                    {{ checkIfFollowing(user) ? 'Unfollow' : 'Follow' }}
                                </Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>
