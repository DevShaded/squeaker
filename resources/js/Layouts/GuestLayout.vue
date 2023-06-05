<script setup lang="ts">
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps<{
    title: string,
    content: string,
    url: string,
}>();

const page = usePage()
const appDomain = computed(() => page.props.app.url)
</script>

<template>
    <Head>
        <title>{{ title }} - Squeaker</title>
        <meta name="description" :content="content">

        <meta property="og:url" :content="`${appDomain}${url}`">
        <meta property="og:title" :content="`${title} - Squeaker`">
        <meta property="og:description" :content="content">
        <meta property="og:image" content="/favicons/android-chrome-512x512.png">

        <meta name="twitter:domain" :content="appDomain">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" :content="`${appDomain}${url}`">
        <meta name="twitter:title" :content="`${title} - Squeaker`">
        <meta name="twitter:description" :content="content">
        <meta name="twitter:image" content="/favicons/android-chrome-512x512.png">
    </Head>

    <div class="min-h-screen bg-gray-50">
        <main>
            <slot />
        </main>
    </div>
</template>
