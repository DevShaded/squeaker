<script setup lang="ts">
import { defineProps, reactive } from 'vue'
import { User } from '../../types/User'
import { Link } from "@inertiajs/vue3";
import Squeak from "../../Components/Squeak.vue";
import { Post } from "../../types/Post";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import ProfileHeader from "../../Components/User/ProfileHeader.vue";
import InformationBadges from "../../Components/User/InformationBadges.vue";
import Description from "../../Components/User/Description.vue";
import FollowersCount from "../../Components/User/FollowersCount.vue";

const props = defineProps<{
    data: User,
}>()

const posts = reactive<Post[]>(props?.data?.posts.data)
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
                                    <ProfileHeader :user="props.data.user.data">
                                        <template #description>
                                            <Description
                                                v-if="props.data.user.data.information"
                                                :information="props.data.user.data.information"
                                            />
                                        </template>

                                        <template #information>
                                            <InformationBadges
                                                v-if="props.data.user.data.information"
                                                :user="props.data.user.data"
                                            />
                                        </template>

                                        <template #followerCount>
                                            <FollowersCount :user="props.data.user.data" />
                                        </template>
                                    </ProfileHeader>
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
                        </article>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
