<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { defineProps, reactive } from "vue";
import { Post } from "../../types/Post";
import PostComponent from "../../Components/Post/Post.vue";
import Reply from "../../Components/Post/Reply.vue";
import Comment from "../../Components/Post/Comment.vue";
import CreateCommentForm from "./Partials/CreateCommentForm.vue";

const props = defineProps<{
    data: object
}>()

const post = reactive<Post>(props.data.data)
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto">
            <PostComponent :data="post"/>

            <div class="mx-4">
                <span>Comments: {{ post.comments_count }}</span>

                <div class="my-3 bg-white">
                    <div class="flex items-start space-x-4">
                        <div class="min-w-0 flex-1">
                            <CreateCommentForm :post="post" />
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="post.comments.length">
                <div v-for="comment in post.comments" :key="comment.id">
                    <Comment :comment="comment" />

                    <div v-for="reply in comment.replies" :key="reply.id">
                        <Reply :reply="reply" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
