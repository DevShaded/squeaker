<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Data } from "../../types/User";

defineProps<{
    person: Data
}>()
</script>

<template>
    <ul role="list">
        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
            <Link :href="'/user/' + person.name" class="flex w-full items-center justify-between space-x-6 p-6 hover:bg-gray-100">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="truncate text-sm font-medium text-gray-900">{{ person.name }}</h3>
                    </div>
                </div>
                <img class="h-14 w-14 flex-shrink-0 rounded-full bg-gray-300" :src="person.avatar" alt="" />
            </Link>
        </li>
    </ul>
</template>

<style scoped>

</style>
