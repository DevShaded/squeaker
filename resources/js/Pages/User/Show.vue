<script setup lang="ts">
import { defineProps, reactive, ref } from 'vue'
import {MapPinIcon, ArrowLeftIcon, CalendarDaysIcon, LinkIcon} from '@heroicons/vue/24/outline'
import { PencilSquareIcon, UserPlusIcon, UserMinusIcon } from '@heroicons/vue/24/solid'
import { User } from '../../types/User'
import { Link, usePage } from "@inertiajs/vue3";
import Squeak from "../../Components/Squeak.vue";
import { Post } from "../../types/Post";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";

const props = defineProps<{
    data: User,
}>()

const isFollowing = ref<boolean>(props.data.user.data.is_following)
const posts = reactive<Post[]>(props?.data?.posts.data)
const authUser = usePage().props.auth.user

let avatar = ref<string>(props.data.user.data.avatar)
if (props.data.user.data.avatar.startsWith('avatar-')) {
    avatar.value = `/storage/avatars/${props.data.user.data.avatar}`
} else {
    avatar.value = props.data.user.data.avatar
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

const handleFollow = () => {
    isFollowing.value = !isFollowing.value

    if (isFollowing.value) {
        return props.data.user.data.followers_count++
    } else {
        return props.data.user.data.followers_count--
    }
}
</script>

<template>
    <div>
        <AuthenticatedLayout>
            <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
                <div class="relative z-0 flex flex-1 overflow-hidden">
                    <div class="relative z-0 flex-1 overflow-y-auto focus:outline-none xl:order-last">
                        <article>
                            <!-- Profile header -->
                            <div class="mb-10">
                                <div class="mx-auto bg-white rounded-md shadow max-w-5xl">
                                    <Link href="/" class="flex bg-gray-800 p-5 text-white">
                                        <ArrowLeftIcon class="h-6 pt-0.5" /> <span class="font-medium pl-5">{{ props.data.user.data.name }}</span>
                                    </Link>
                                    <div>
                                        <img class="h-32 w-full object-cover lg:h-48" src="https://images.unsplash.com/photo-1444628838545-ac4016a5418a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="" />
                                    </div>
                                    <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5 px-4 sm:px-6 lg:px-8">
                                        <div class="flex">
                                            <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32" :src="avatar" alt="" />
                                        </div>
                                        <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                                            <div class="mt-6 min-w-0 flex-1 2xl:block">
                                                <h1 class="truncate text-2xl font-bold text-gray-900">{{ props.data.user.data.name }}</h1>
                                            </div>
                                            <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                                                <div v-if="props.data.user.data.id === authUser.id">
                                                    <Link href="/user/settings/profile" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                        <PencilSquareIcon class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                                        Edit profile
                                                    </Link>
                                                </div>
                                                <div v-else>
                                                    <Link :href="!isFollowing ? '/follow/' + props.data.user.data.id : '/unfollow/' + props.data.user.data.id"  method="post" as="button" type="button" @click="handleFollow" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                        <UserPlusIcon v-if="!isFollowing" class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                                        <UserMinusIcon v-if="isFollowing" class="-ml-0.5 h-5 w-5 text-red-500" aria-hidden="true" />
                                                        {{ !isFollowing ? 'Follow' : 'Unfollow' }}
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description list -->
                                    <div class="mx-auto bg-white mt-6 max-w-5xl px-4 sm:px-6 lg:px-8">
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                            <div class="sm:col-span-2">
                                                <dt class="text-sm font-medium text-gray-500">About</dt>
                                                <dd class="mt-1 max-w-prose space-y-5 text-sm text-gray-900">
                                                    <p v-if="props.data.user.data.information" v-html="props.data.user.data.information.description"/>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>

                                    <div class="mx-auto mt-8 max-w-5xl px-4 pb-4 sm:px-6 lg:px-8">
                                        <h2 class="text-sm font-medium text-gray-500">Information</h2>
                                        <div v-if="props.data.user.data.information" class="mt-1 flex flex-col sm:flex-row sm:space-x-4">
                                            <span v-if="props.data.user.data.information.country?.name" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><MapPinIcon class="h-4 pr-1" /> {{ props.data.user.data.information.country?.name }}</span>
                                            <span v-if="props.data.user.data.information.dob" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><CalendarDaysIcon class="h-4 pr-1" /> Born {{ timestampToDate(props.data.user.data.information.dob) }}</span>
                                            <a v-if="props.data.user.data.information.website" :href="props.data.user.data.information.website" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><LinkIcon class="h-4 pr-1" /> {{ props.data.user.data.information.website }}</a>
                                            <span v-if="props.data.user.data.created_at" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><CalendarDaysIcon class="h-4 pr-1" /> Joined on {{ timestampToDate(props.data.user.data.created_at) }}</span>
                                        </div>
                                    </div>

                                    <!-- Description list -->
                                    <div class="mx-auto bg-white max-w-5xl px-4 sm:px-6 lg:px-8">
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                            <div class="sm:col-span-2">
                                                <dd class="mt-1 max-w-prose space-y-5 text-sm text-gray-900">
                                                    <div class="flex">
                                                        <!-- Followes Count -->
                                                        <div class="flex-1 flex space-x-5 border-t border-b border-gray-200 py-4">
                                                            <div class="text-center">
                                                                <dt class="flex text-sm font-medium text-gray-600"><div class="pr-1 text-gray-800">{{ formatNumber(props.data.user.data.following_count, 0) }}</div> Following</dt>
                                                            </div>
                                                            <div class="text-center">
                                                                <dt class="flex text-sm font-medium text-gray-600"><div class="pr-1 text-gray-800">{{ formatNumber(props.data.user.data.followers_count, 0) }}</div> Followers</dt>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>

                                <div class="max-w-3xl mx-auto my-10">
                                    <div v-for="squeak in posts" class="mx-auto">
                                        <Squeak :squeak="squeak" :key="squeak.id" class="bg-white px-4 py-6 my-5 shadow sm:rounded-lg sm:p-6" />
                                    </div>

                                    <div class="flex justify-end items-end space-x-3 mt-4">
                                        <Link v-if="props.data.posts.links.prev" :href="props.data.posts.links.prev" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Previous Page</Link>
                                        <Link v-if="props.data.posts.links.next" :href="props.data.posts.links.next" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next Page</Link>
                                        <Link v-if="props.data.posts.meta.current_page === props.data.posts.links.last" href="/" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go to start page</Link>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
