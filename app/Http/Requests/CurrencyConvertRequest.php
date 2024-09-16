<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Enum\CurrencyEnum;
use App\Models\Enum\GenderConstEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CurrencyConvertRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        ;
        return [
            'amount' => ['required', 'numeric', 'min:0'],
            'from_currency' => ['required', new Enum(CurrencyEnum::class)],
            'to_currency' => ['required', new Enum(CurrencyEnum::class)],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated();

        if (array_key_exists('from_currency', $data) && $data['from_currency'] !== null) {
            $data['from_currency'] = CurrencyEnum::getEnumFromName(strtoupper($data['from_currency']));
        }

        if (array_key_exists('to_currency', $data) && $data['to_currency'] !== null) {
            $data['to_currency'] = CurrencyEnum::getEnumFromName(strtoupper($data['to_currency']));
        }

        return $data;
    }
}
