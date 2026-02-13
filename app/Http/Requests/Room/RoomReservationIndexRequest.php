<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomReservationIndexRequest extends FormRequest
{
    public const PER_PAGE = 'per_page';
    public const PAGE = 'page';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * === Prepare the data for validation. ===
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            self::PER_PAGE => $this->input(self::PER_PAGE) ?? 8,
            self::PAGE => $this->input(self::PAGE) ?? 1,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            self::PER_PAGE => ['nullable', 'integer', Rule::in([4, 8, 16, 32, 64])],
            self::PAGE => ['nullable', 'integer', 'gte:0'],
            // 'search'   => 'nullable|string|max:255',
            // 'sort_by'  => ['nullable', 'string', Rule::in(['name', 'price'])],
        ];
    }
}
