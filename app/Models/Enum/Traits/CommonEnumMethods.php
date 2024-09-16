<?php

declare(strict_types=1);

namespace App\Models\Enum\Traits;

use Illuminate\Support\Arr;
use ValueError;

trait CommonEnumMethods
{
    public static function toAssocArray(): array
    {
        return Arr::pluck(self::cases(), 'value', 'name');
    }

    public static function toListArray(): array
    {
        return Arr::pluck(self::cases(), 'value');
    }

    public static function toNestedArrayByName(): array
    {
        return array_map(function ($v) {
            return ['name' => $v->name, 'value' => $v->value];
        }, self::cases());
    }

    public static function getEnumFromName(string $name): static
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        throw new ValueError("$name is not a valid backing value for enum " . self::class);
    }
}
