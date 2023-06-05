export function getAvatar(avatar: string): string {
    if (avatar.startsWith('avatar-')) {
        return `/storage/avatars/${avatar}`;
    } else {
        return avatar;
    }
}
