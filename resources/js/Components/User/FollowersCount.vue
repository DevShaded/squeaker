<script setup lang="ts">
import { Data } from "../../types/User";
defineProps<{
    user: Data
}>()

function formatNumber(number: number = 0, dec: number): string | undefined {
    if (isNaN(number)) {
        number = 0
    }
    switch (dec) {
        case 0:
            return number.toLocaleString('en-US', { maximumFractionDigits: 0, minimumFractionDigits: 0 })
        case 1:
            return number.toLocaleString('en-US', { maximumFractionDigits: 1, minimumFractionDigits: 1 })
        case 2:
            return number.toLocaleString('en-US', { maximumFractionDigits: 2, minimumFractionDigits: 2 })
    }
}
</script>

<template>
    <div class="mx-auto bg-white max-w-5xl px-4 sm:px-6 lg:px-8">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <dd class="mt-1 max-w-prose space-y-5 text-sm text-gray-900">
                    <div class="flex">
                        <!-- Followes Count -->
                        <div class="flex-1 flex space-x-5 border-t border-b border-gray-200 py-4">
                            <div class="text-center">
                                <dt class="flex text-sm font-medium text-gray-600"><div class="pr-1 text-gray-800">{{ formatNumber(user.following_count, 0) }}</div> Following</dt>
                            </div>
                            <div class="text-center">
                                <dt class="flex text-sm font-medium text-gray-600"><div class="pr-1 text-gray-800">{{ formatNumber(user.followers_count, 0) }}</div> Followers</dt>
                            </div>
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<style scoped>

</style>
