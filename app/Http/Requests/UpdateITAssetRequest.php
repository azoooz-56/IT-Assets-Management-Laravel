<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateITAssetRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust according to your authorization needs
    }

    public function rules()
    {
        return [
            'brand' => 'sometimes|required|string|max:255',
            'serial_number' => 'sometimes|required|string|unique:it_asset,serial_number,',
            'warranty_expiration_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:New,In Use,Damaged,Dispose',
        ];
    }
}
