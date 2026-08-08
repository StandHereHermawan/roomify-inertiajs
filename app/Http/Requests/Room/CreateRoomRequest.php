<?php

namespace App\Http\Requests\Room;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRoomRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Room::NAME => ['nullable', 'string', 'min:5'],
            Room::CODE => ['required', 'string', 'min:4', Rule::unique(Room::TABLE_NAME, Room::CODE)],
            Room::DESCRIPTION => ['nullable', 'string', 'min:8'],
            Room::HEIGHT_IN_METER => ['numeric', 'required', 'min:0'],
            Room::FLOOR_WIDE_IN_METER_SQUARED => ['numeric', 'required', 'min:0'],
        ];
    }
}
