<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreITAssetRequest extends FormRequest
{

    public function rules()
    {
        return [
            'brand' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:it_asset,serial_number',
            'warranty_expiration_date' => 'required|date',
            'status' => 'required|in:New,In Use,Damaged,Dispose',
        ];
    }
}
