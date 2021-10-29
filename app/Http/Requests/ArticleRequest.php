<?php

namespace App\Http\Requests;

use App\Models\Article;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:10|max:255',
            'status' => 'nullable',
            'description' => 'required|min:150',
            'feature_image' => 'nullable|image',
        ];
    }
}
