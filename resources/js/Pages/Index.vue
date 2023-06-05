<script setup lang="ts">
import { ArrowTrendingUpIcon, FireIcon, HomeIcon, UserGroupIcon } from '@heroicons/vue/24/outline'
import { defineProps, reactive, ref } from "vue";
import { Post } from "../types/Post";
import { Link } from "@inertiajs/vue3";
import { TrendingPosts } from "../types/TrendingPosts";
import { WhoToFollowType } from "../types/WhoToFollow";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
import WhoToFollowComponent from "../Components/WhoToFollow.vue";
import TrendingSqueaks from "../Components/TrendingSqueaks.vue";
import Squeak from "../Components/Squeak.vue";

const props = defineProps<{
    data: object,
}>()

const recentPosts = reactive<Post[]>(props?.data?.posts.recent.data)
const mostLikedPosts = reactive<Post[]>(props?.data?.posts.mostLiked.data)
const trendingPosts = reactive<TrendingPosts[]>(props?.data?.trendingPosts)
const whoToFollow = reactive<WhoToFollowType>(props?.data?.whoToFollow)

const navigation = [
    { name: 'Home', href: '#', icon: HomeIcon, current: true },
    { name: 'Popular', href: '#', icon: FireIcon, current: false },
    { name: 'Communities', href: '#', icon: UserGroupIcon, current: false },
    { name: 'Trending', href: '#', icon: ArrowTrendingUpIcon, current: false },
]

const tabs = [
    { name: 'Recent', href: '#', current: true },
    { name: 'Most Liked', href: '#', current: false },
]

const selectedTab = ref(0)
function changeTab(index) {
    selectedTab.value = index
}
</script>


<template>
    <AuthenticatedLayout title="Home" content="Discover Squaker, the ultimate platform to freely express yourself and share your thoughts with the world. Unleash your inner voice and let your mind speak. Join Squaker today and connect with a vibrant community of like-minded individuals ready to listen, engage, and support you." url="/">
    <div class="py-10">
        <div class="mx-auto max-w-3xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-8 lg:px-8">
            <div class="hidden lg:col-span-3 lg:block xl:col-span-2">
                <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
                    <div class="space-y-1 pb-8">
                        <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:bg-gray-50', 'group flex items-center rounded-md px-3 py-2 text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">
                            <component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-1 mr-3 h-6 w-6 flex-shrink-0']" aria-hidden="true" />
                            <span class="truncate">{{ item.name }}</span>
                        </a>
                    </div>
                </nav>
            </div>
            <section class="lg:col-span-9 xl:col-span-6">
                <TabGroup as="template" :selectedIndex="selectedTab" @change="changeTab">
                    <TabList class="px-4 sm:px-0">
                        <TabList class="block mx-4">
                            <nav class="isolate divide-x flex divide-gray-200 rounded-lg shadow" aria-label="Tabs">
                                <Tab v-for="(tab, tabIdx) in tabs" :key="tab.name" v-slot="{ selected }" :href="tab.href" :aria-current="tab.current ? 'page' : undefined" :class="[tab.current ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700', tabIdx === 0 ? 'rounded-l-lg' : '', tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '', 'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-center text-sm font-medium hover:bg-gray-50 focus:z-10']">
                                    <span>{{ tab.name }}</span>
                                    <span aria-hidden="true" :class="[selected ? 'bg-indigo-500' : 'bg-transparent', 'absolute inset-x-0 bottom-0 h-0.5']" />
                                </Tab>
                            </nav>
                        </TabList>
                    </TabList>
                    <div class="mt-4">
                        <h1 class="sr-only">Recent Squeaks</h1>
                        <TabPanels role="list" class="space-y-4">
                            <TabPanel>
                                <ul v-for="squeak in recentPosts" :key="squeak.id" class="bg-white mx-4 my-6 px-4 py-6 shadow sm:rounded-lg sm:p-6">
                                    <Squeak :squeak="squeak" />
                                </ul>

                                <div class="flex justify-end items-end space-x-3 mt-4 pr-4">
                                    <Link v-if="props.data.posts.recent.links.prev" :href="props.data.posts.recent.links.prev" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Previous Page</Link>
                                    <Link v-if="props.data.posts.recent.links.next" :href="props.data.posts.recent.links.next" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next Page</Link>
                                    <Link v-if="props.data.posts.recent.meta.current_page === props.data.posts.recent.links.last" href="/" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go to start page</Link>
                                </div>
                            </TabPanel>

                            <TabPanel>
                                <ul v-for="squeak in mostLikedPosts" :key="squeak.id" class="bg-white mx-4 my-6 px-4 py-6 shadow sm:rounded-lg sm:p-6">
                                    <Squeak :squeak="squeak" />
                                </ul>

                                <div class="flex justify-end items-end space-x-3 mt-4 pr-4">
                                    <Link v-if="props.data.posts.mostLiked.links.prev" :href="props.data.posts.recent.links.prev" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Previous Page</Link>
                                    <Link v-if="props.data.posts.mostLiked.links.next" :href="props.data.posts.recent.links.next" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next Page</Link>
                                    <Link v-if="props.data.posts.mostLiked.meta.current_page === props.data.posts.recent.links.last" href="/" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go to start page</Link>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </div>
                </TabGroup>
            </section>
            <aside class="hidden xl:col-span-4 xl:block">
                <div class="sticky top-4 space-y-4">
                    <WhoToFollowComponent :who-to-follow="whoToFollow" />
                    <TrendingSqueaks :trending-squeaks="trendingPosts" />
                </div>
            </aside>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
