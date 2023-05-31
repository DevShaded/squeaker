<script setup lang="ts">
import { Data } from "../../types/User";
import { CalendarDaysIcon, LinkIcon, MapPinIcon } from "@heroicons/vue/24/outline";

defineProps<{
    user: Data
}>()

const timestampToDate = (timestamp: string) => {
    const date = new Date(timestamp)
    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}
</script>

<template>
    <div class="mx-auto mt-8 max-w-5xl px-4 pb-4 sm:px-6 lg:px-8">
        <h2 class="text-sm font-medium text-gray-500">Information</h2>
        <div class="mt-1 flex flex-col sm:flex-row sm:space-x-4">
            <span v-if="user.information.country?.name" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><MapPinIcon class="h-4 pr-1" /> {{ user.information.country?.name }}</span>
            <span v-if="user.information.dob" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><CalendarDaysIcon class="h-4 pr-1" /> Born {{ timestampToDate(user.information.dob) }}</span>
            <a v-if="user.information.website" :href="user.information.website" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><LinkIcon class="h-4 pr-1" /> {{ user.information.website }}</a>
            <span v-if="user.created_at" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-2 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"><CalendarDaysIcon class="h-4 pr-1" /> Joined on {{ timestampToDate(user.created_at) }}</span>
        </div>
    </div>
</template>

<style scoped>

</style>
