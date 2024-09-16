<?php

declare(strict_types=1);

namespace App\Models\Enum;

use App\Models\Enum\Traits\CommonEnumMethods;

enum CurrencyEnum: string
{
    use CommonEnumMethods;

    case USD = 'USD';
    case EUR = 'EUR';
    case JPY = 'JPY';
    case GBP = 'GBP';
    case CAD = 'CAD';
    case CHF = 'CHF';
    case CNY = 'CNY';
    case RUB = 'RUB';
    case HKD = 'HKD';

    public function title(): string
    {
        return match($this) {
            self::USD => 'United States Dollar',
            self::EUR => 'Euro (used by Eurozone countries)',
            self::JPY => 'Japanese Yen',
            self::GBP => 'British Pound Sterling',
            self::CAD => 'Canadian Dollar',
            self::CHF => 'Swiss Franc',
            self::CNY => 'Chinese Yuan',
            self::RUB => 'Russian Ruble',
            self::HKD => 'Hong Kong Dollar',
        };
    }
}
