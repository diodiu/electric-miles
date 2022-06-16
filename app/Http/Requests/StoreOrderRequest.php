<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'expectedTimeOfDelivery' => 'required|date',
            'deliveryAddress' => 'required|string',
            'billingAddress' => 'required|string',
            'items' => 'required|array',
            'items.*.id' => 'required|int',
            'items.*.quantity' => 'required|int'
        ];
    }
}
