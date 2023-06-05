<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import CreatePostForm from "./Partials/CreatePostForm.vue";
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

                    <CreatePostForm />
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
