<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { Link } from "@inertiajs/vue3";
import { Data } from "../../types/User";

defineProps<{
    user: Data,
    userNavigation: Array<{ name: string, href: string }>
}>()
</script>

<template>
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
</template>

<style scoped>

</style>
