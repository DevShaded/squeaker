<script setup lang="ts">
import { ref } from 'vue';

const msg = ref('Welcome to your Laravel Inertia Starter Template!');
</script>

<template>
    <h1 class="text-3xl font-bold underline">
        {{ msg }}
    </h1>
</template>
