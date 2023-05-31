<script setup lang="ts">
import { Information } from "../../types/User";

defineProps<{
    information: Information
}>()
</script>

<template>
    <div class="mx-auto bg-white mt-6 max-w-5xl px-4 sm:px-6 lg:px-8">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">About</dt>
                <dd class="mt-1 max-w-prose space-y-5 text-sm text-gray-900">
                    <p v-html="information.description"/>
                </dd>
            </div>
        </dl>
    </div>
</template>

<style scoped>

</style>
