export interface WhoToFollowType {
    data?: (DataEntity)[] | null;
}

export interface DataEntity {
    id: string;
    name: string;
    avatar: string;
}
