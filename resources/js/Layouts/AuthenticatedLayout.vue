<script setup lang="ts">
import {Popover, PopoverButton, PopoverPanel} from "@headlessui/vue";
import {Bars3Icon, HomeIcon, XMarkIcon} from "@heroicons/vue/24/outline";
import {Link, usePage, Head} from "@inertiajs/vue3";
import { computed, ref } from "vue";
import SearchForm from "./Partials/SearchForm.vue";
import ProfileDropdown from "../Components/Layout/ProfileDropdown.vue";
import { getAvatar } from "../utils/getAvatar";

defineProps<{
    title: string,
    content: string,
    url: string,
    image?: string,
}>();

const page = usePage()

const user = computed(() => page.props.auth.user)
const appDomain = computed(() => page.props.app.url)

const userNavigation = [
    { name: 'Your Profile', href: '/user/' + user.value.name },
    { name: 'Settings', href: '/user/settings' },
]

const navigation = [
    { name: 'Home', href: '/', icon: HomeIcon, current: true },
]

const avatar = ref(getAvatar(user.value.avatar));
</script>

<template>
    <Head>
        <title>{{ title }} - Squeaker</title>
        <meta name="description" :content="content">

        <meta property="og:url" :content="`${appDomain}${url}`">
        <meta property="og:title" :content="`${title} - Squeaker`">
        <meta property="og:description" :content="content">
        <meta property="og:image" :content="!image ? `/favicons/android-chrome-512x512.png` : getAvatar(image)">

        <meta name="twitter:domain" :content="appDomain">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" :content="`${appDomain}${url}`">
        <meta name="twitter:title" :content="`${title} - Squeaker`">
        <meta name="twitter:description" :content="content">
        <meta name="twitter:image" :content="!image ? `/favicons/android-chrome-512x512.png` : getAvatar(image)">
    </Head>

    <div class="min-h-full bg-gray-50">
        <Popover as="template" v-slot="{ open }">
            <header :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', 'bg-white shadow-sm lg:static lg:overflow-y-visible']">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
                        <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
                            <div class="flex flex-shrink-0 items-center">
                                <Link href="/">
                                    <img class="block h-14 w-auto" src="../../images/logo.png" alt="Squeaker" />
                                </Link>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
                            <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                                <SearchForm />
                            </div>
                        </div>
                        <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
                            <!-- Mobile menu button -->
                            <PopoverButton class="-mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Open menu</span>
                                <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                                <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                            </PopoverButton>
                        </div>
                        <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
                            <!-- Profile dropdown -->
                            <ProfileDropdown :user-navigation="userNavigation" :user="user" />

                            <Link href="/post/create" class="ml-6 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">New Post</Link>
                        </div>
                    </div>
                </div>

                <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
                    <div class="mx-auto max-w-3xl space-y-1 px-2 pb-3 pt-2 sm:px-4">
                        <Link v-for="item in navigation"
                              :key="item.name"
                              :href="item.href"
                              :aria-current="item.current ? 'page' : undefined"
                              :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">
                            {{ item.name }}
                        </Link>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="mx-auto flex max-w-3xl items-center px-4 sm:px-6">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="avatar" :alt="user.name" />
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
                            </div>
                        </div>
                        <div class="mx-auto mt-3 max-w-3xl space-y-1 px-2 sm:px-4">
                            <Link v-for="item in userNavigation" :key="item.name" :href="item.href" class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">{{ item.name }}</Link>
                            <div class="w-full bg-gray-100 hover:bg-gray-200 rounded-md">
                                <Link href="/logout" method="post" as="button" type="button" class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-900">Sign out</Link>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto mt-6 max-w-3xl px-4 sm:px-6">
                        <Link href="/post/create" class="inline-flex w-full items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">New Post</Link>
                    </div>
                </PopoverPanel>
            </header>
        </Popover>

        <!-- Main Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="mt-8 md:order-1 md:mt-0">
                    <p class="text-center text-xs leading-5 text-gray-500">&copy; {{ new Date().getFullYear() }} Squeaker, Inc. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
