<script setup lang="ts">
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";

const form = reactive({
    name: null,
})

function submit() {
    router.post('/search?username=' + form.name)
}
</script>

<template>
    <form @submit.prevent="submit" class="w-full">
        <InputLabel for="search" value="Search" class="sr-only" />
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <TextInput
                v-model="form.name"
                id="search"
                name="search"
                class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                placeholder="Search for a user!"
                type="search"
            />
        </div>
    </form>
</template>

<style scoped>

</style>
