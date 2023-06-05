<script setup lang="ts">
import { Data } from '../../types/User'
import { PencilSquareIcon, UserMinusIcon, UserPlusIcon } from "@heroicons/vue/24/solid";
import { ArrowLeftIcon } from "@heroicons/vue/24/outline";
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps<{
    user: Data
}>()

const page = usePage()
const authUser = computed(() => page.props.auth.user)

const isFollowing = ref<boolean>()
const handleFollow = () => {
    isFollowing.value = !isFollowing.value

    if (isFollowing.value) {
        return props.user.followers_count++
    } else {
        return props.user.followers_count--
    }
}
</script>

<template>
<div>
    <Link href="/" class="flex bg-gray-800 p-5 text-white">
        <ArrowLeftIcon class="h-6 pt-0.5" /> <span class="font-medium pl-5">{{ props.user.name }}</span>
    </Link>
    <div>
        <img class="h-32 w-full object-cover lg:h-48" src="https://images.unsplash.com/photo-1444628838545-ac4016a5418a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="" />
    </div>
    <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5 px-4 sm:px-6 lg:px-8">
        <div class="flex">
            <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32" :src="props.user.avatar" alt="" />
        </div>
        <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
            <div class="mt-6 min-w-0 flex-1 2xl:block">
                <h1 class="truncate text-2xl font-bold text-gray-900">{{ props.user.name }}</h1>
            </div>
            <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                <div v-if="props.user.id === authUser.id">
                    <Link href="/user/settings/profile" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <PencilSquareIcon class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                        Edit profile
                    </Link>
                </div>
                <div v-else>
                    <Link :href="!isFollowing ? '/follow/' + props.user.id : '/unfollow/' + props.user.id"  method="post" as="button" type="button" @click="handleFollow" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <UserPlusIcon v-if="!isFollowing" class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                        <UserMinusIcon v-if="isFollowing" class="-ml-0.5 h-5 w-5 text-red-500" aria-hidden="true" />
                        {{ !isFollowing ? 'Follow' : 'Unfollow' }}
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <slot name="description" />

    <slot name="information" />

    <slot name="followerCount" />
</div>
</template>

<style scoped>

</style>
