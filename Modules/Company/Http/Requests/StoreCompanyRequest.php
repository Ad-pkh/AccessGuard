<?php

declare(strict_types=1);

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('companies', 'email')],
            'address' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
