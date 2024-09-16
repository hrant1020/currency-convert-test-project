<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Enum\CurrencyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    public const string BASE_DEFAULT_CURRENCY = CurrencyEnum::USD->value;
    public const int PRECISION = 10;

    protected $fillable = [
        'group_uniq_id',
        'currency_iso_name',
        'rate',
    ];
}
