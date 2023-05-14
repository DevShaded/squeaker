<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    content: null,
})

const submit = () => {
    form.post('/post/store')
}
</script>

<template>
    <AuthenticatedLayout>
        <section class="mx-5">
            <div class="max-w-3xl mx-auto bg-white my-10 p-5 rounded-md shadow">
                <div class="mx-5">
                    <div class="my-3">
                        <h1 class="pb-4 text-xl">Create a post!</h1>
                        <p class="text-sm text-gray-600">What are you squeaking about?</p>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <textarea v-model="form.content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight border-gray-400 focus:shadow-outline" id="content" name="content" rows="5" placeholder="Enter your post content here"></textarea>
                            <div v-if="form.errors.content" class="text-red-600 font-medium">{{ form.errors.content }}</div>
                        </div>
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" :disabled="form.processing">
                            Squeak it!
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
