<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";

const msg = ref('Welcome to your Laravel Inertia Starter Template!');
</script>

<template>
    <AuthenticatedLayout>
            <h1 class="text-3xl font-bold underline">
                {{ msg }}
            </h1>
    </AuthenticatedLayout>
</template>
