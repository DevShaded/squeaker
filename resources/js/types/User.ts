export interface User {
    user: User1;
    posts: Posts;
}
export interface User1 {
    data: Data;
}
export interface Data {
    id: string;
    name: string;
    email: string;
    avatar: string;
    created_at: string;
    updated_at: string;
    information: Information;
    is_following: boolean;
    followers_count: number;
}
export interface Information {
    id: string;
    user_id: string;
    description?: null;
    dob?: null;
    country?: Country | null;
    website?: null;
    created_at: string;
    updated_at: string;
}

export interface Country {
    name: string;
}
export interface Posts {
    data?: (DataEntity)[] | null;
    links: Links;
    meta: Meta;
}
export interface DataEntity {
    id: string;
    likes: number;
    views: number;
    content: string;
    created_at: string;
    updated_at: string;
    comments_count: number;
    has_liked: boolean;
    user_id: string;
    user: User2;
}
export interface User2 {
    id: string;
    name: string;
    email: string;
    avatar: string;
    created_at: string;
    updated_at: string;
    is_following: boolean;
}
export interface Links {
    first: string;
    last?: null;
    prev?: null;
    next?: null;
}
export interface Meta {
    current_page: number;
    from: number;
    path: string;
    per_page: number;
    to: number;
}
