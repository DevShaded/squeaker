export interface TrendingPosts {
    id: string;
    user_id: string;
    likes: number;
    views: number;
    content: string;
    created_at: string;
    updated_at: string;
    comments_count: number;
    user: User;
}
export interface User {
    id: string;
    name: string;
    email: string;
    email_verified_at: string;
    avatar: string;
    created_at: string;
    updated_at: string;
}
