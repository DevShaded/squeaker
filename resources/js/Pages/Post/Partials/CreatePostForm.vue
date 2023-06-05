<script setup lang="ts">
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import TextAreaInput from "../../../Components/TextAreaInput.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    content: null,
})

const submit = () => {
    form.post('/post/store')
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="mb-4">
            <TextAreaInput
                v-model="form.content"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight border-gray-400 focus:shadow-outline"
                id="content"
                name="content"
                rows="5"
                placeholder="Enter your post content here"
                required
            />
            <div v-if="form.errors.content" class="text-red-600 font-medium">{{ form.errors.content }}</div>
        </div>

        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Squeak it!
        </PrimaryButton>
    </form>
</template>

<style scoped>

</style>
