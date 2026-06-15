<?php

namespace App\Support;

final class AdminRoles
{
    public const SUPER_ADMIN = 'super-admin';
    public const LEGACY_SUPER_ADMIN = 'super_admin';
    public const ADMIN = 'admin';
    public const EDITOR = 'editor';
    public const WRITER = 'writer';
    public const USER = 'user';

    public static function superAdminRoles(): array
    {
        return [self::SUPER_ADMIN, self::LEGACY_SUPER_ADMIN];
    }

    public static function managementRoles(): array
    {
        return [
            ...self::superAdminRoles(),
            self::ADMIN,
        ];
    }

    public static function moderationRoles(): array
    {
        return [
            ...self::managementRoles(),
            self::EDITOR,
        ];
    }

    public static function adminAccessRoles(): array
    {
        return [
            ...self::moderationRoles(),
            self::WRITER,
        ];
    }
}