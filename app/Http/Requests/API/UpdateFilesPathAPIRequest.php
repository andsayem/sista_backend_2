<?php

namespace App\Http\Requests\API;

use App\Models\FilesPath;
use InfyOm\Generator\Request\APIRequest;

class UpdateFilesPathAPIRequest extends APIRequest
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
        $rules = FilesPath::$rules;
        
        return $rules;
    }
}
