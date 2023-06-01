<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import UserCard from "../../Components/Search/UserCard.vue";
import UserNotFound from "../../Components/Search/UserNotFound.vue";

defineProps<{
    data: object,
}>()
</script>

<template>
    <AuthenticatedLayout>
        <section class="max-w-3xl mx-auto my-10">
            <div v-if="data.data.length" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div v-for="person in data.data">
                    <UserCard :person="person" />
                </div>
            </div>

            <div v-else class="bg-white shadow sm:rounded-lg mx-5">
                <UserNotFound />
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
