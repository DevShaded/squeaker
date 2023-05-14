<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps<{
    data: object,
}>()
</script>

<template>
    <AuthenticatedLayout>
        <section class="max-w-3xl mx-auto my-10">
            <div v-if="data.data.length" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div v-for="person in data.data" :key="person.email" class="relative flex items-center space-x-3 mx-5 rounded-lg border border-gray-100 bg-white px-6 py-8 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-300">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="person.avatar" alt="" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <Link :href="'/user' + person.name" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true" />
                            <p class="text-sm font-medium text-gray-900">{{ person.name }}</p>
                        </Link>
                    </div>
                </div>
            </div>

            <div v-else class="bg-white shadow sm:rounded-lg mx-5">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">That user could not found!</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>We apologize, but it seems that the username you entered could not be found. Please try a different username.</p>
                    </div>
                    <div class="mt-5">
                        <Link href="/" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Home</Link>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
