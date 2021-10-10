<?php

namespace JacobHyde\Tickets\App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'string',
            'email' => 'required|email',
            'phone' => 'string',
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string',
            'message' => 'required|string',
            'metadata' => 'array',
        ];
    }
}
