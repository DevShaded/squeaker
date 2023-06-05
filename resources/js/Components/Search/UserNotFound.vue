<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-base font-semibold leading-6 text-gray-900">That user could not found!</h3>
        <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>We apologize, but it seems that the username you entered could not be found. Please try a different username.</p>
        </div>
        <div class="mt-5">
            <Link href="/" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Home</Link>
        </div>
    </div>
</template>

<style scoped>

</style>
