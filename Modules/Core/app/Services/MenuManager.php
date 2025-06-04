<?php

namespace Modules\Core\Services;

class MenuManager
{
    protected static array $menus = [];

    public static function add(array $menu): void
    {
        self::$menus[] = $menu;
    }

    public static function all(): array
    {
        usort(self::$menus, fn($a, $b) => ($a['priority'] ?? 999) <=> ($b['priority'] ?? 999));
        return self::$menus;
    }

    public static function clear(): void
    {
        self::$menus = [];
    }
}
