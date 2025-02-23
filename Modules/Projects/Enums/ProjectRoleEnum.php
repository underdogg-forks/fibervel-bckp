<?php

namespace Modules\Projects\Enums;

enum ProjectRoleEnum: string
{
    case CONTRIBUTOR = 'contributor';
    case LEAD = 'lead';
    case MANAGER = 'manager';
    case MEMBER = 'member';
    case OWNER = 'owner';

    case VIEWER = 'viewer';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}
