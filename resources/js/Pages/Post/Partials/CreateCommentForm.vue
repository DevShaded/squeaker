<script setup lang="ts">
import InputLabel from "../../../Components/InputLabel.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import InputError from "../../../Components/InputError.vue";
import TextAreaInput from "../../../Components/TextAreaInput.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { Post } from "../../../types/Post";
import { computed } from "vue";

const props = defineProps<{
    post: Post
}>()

const page = usePage()
const user = computed(() => page.props.auth.user)

const form = useForm({
    content: null,
    post_id: props.post.id,
    user_id: user.value.id,
})

function submit() {
    router.post('/squeak/' + props.post.id + '/comment', form, {
        preserveScroll: true,
        preserveState: false,
    })
}
</script>

<template>
    <form @submit.prevent="submit" class="relative">
        <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300">
            <InputLabel value="Add your comment" for="comment" class="sr-only" />

            <TextAreaInput
                rows="3"
                name="comment"
                id="comment"
                required
                v-model="form.content"
                class="w-full"
                placeholder="Add your comment..."
            />

            <InputError :message="form.errors.content" class="mt-2" />

            <!-- Spacer element to match the height of the toolbar -->
            <div class="py-2" aria-hidden="true">
                <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                <div class="py-px">
                    <div class="h-9" />
                </div>
            </div>
        </div>

        <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
            <div class="flex-shrink-0">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Post
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
