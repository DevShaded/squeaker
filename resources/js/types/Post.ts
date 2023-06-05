export interface Post {
    id: string;
    likes: number;
    views: number;
    content: string;
    created_at: string;
    updated_at: string;
    comments_count: number;
    likes_count: number;
    has_liked: boolean;
    user_id: string;
    user: User;
    comments?: (CommentsEntity)[] | null;
}
export interface User {
    id: string;
    name: string;
    email: string;
    avatar: string;
    created_at: string;
    updated_at: string;
}
export interface CommentsEntity {
    id: string;
    content: string;
    created_at: string;
    updated_at: string;
    user_id: string;
    user: User;
    post_id: string;
    post: Post;
    replies?: (RepliesEntity)[] | null;
}
export interface RepliesEntity {
    id: string;
    user_id: string;
    user?: User;
    comment_id: string;
    content: string;
    created_at: string;
    updated_at: string;
}
