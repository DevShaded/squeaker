<script setup lang="ts">
import {Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel} from "@headlessui/vue";
import {MagnifyingGlassIcon} from "@heroicons/vue/20/solid";
import {Bars3Icon, HomeIcon, XMarkIcon} from "@heroicons/vue/24/outline";
import {Link, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const userNavigation = [
    { name: 'Your Profile', href: '#' },
    { name: 'Settings', href: '#' },
]

const navigation = [
    { name: 'Home', href: '#', icon: HomeIcon, current: true },
]

const page = usePage()

const user = computed(() => page.props.auth.user)
</script>

<template>
    <div class="min-h-full bg-gray-50">
        <Popover as="template" v-slot="{ open }">
            <header :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', 'bg-white shadow-sm lg:static lg:overflow-y-visible']">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
                        <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
                            <div class="flex flex-shrink-0 items-center">
                                <Link href="/" class="font-medium">
                                    Squeaker
                                </Link>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
                            <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                                <div class="w-full">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </div>
                                        <input id="search" name="search" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" placeholder="Search" type="search" />
                                    </div>
                                </div>
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
                            <Menu as="div" class="relative ml-5 flex-shrink-0">
                                <div>
                                    <MenuButton class="flex rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" :src="user.avatar" :alt="user.name" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                            <Link :href="item.href" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ item.name }}</Link>
                                        </MenuItem>
                                        <div class="w-full hover:bg-gray-100 focus:bg-gray-100">
                                            <Link class="block px-4 py-2 text-sm text-gray-700" href="/logout" method="post" as="button" type="button">Sign out</Link>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>

                            <Link href="#" class="ml-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">New Post</Link>
                        </div>
                    </div>
                </div>

                <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
                    <div class="mx-auto max-w-3xl space-y-1 px-2 pb-3 pt-2 sm:px-4">
                        <a v-for="item in navigation" :key="item.name" :href="item.href" :aria-current="item.current ? 'page' : undefined" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">{{ item.name }}</a>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="mx-auto flex max-w-3xl items-center px-4 sm:px-6">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="user.avatar" :alt="user.name" />
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
                        <Link href="#" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">New Post</Link>
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
