<?php

namespace TypiCMS\Modules\Abouts\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'slug.*' => 'nullable|alpha_dash|max:255|required_if:status.*,1|required_with:title.*',
            'status.*' => 'boolean',
            'body.*' => 'nullable',
            'meta_title.*' => 'nullable|max:255',
            'meta_keywords.*' => 'nullable|max:255',
            'meta_description.*' => 'nullable|max:255',
        ];
    }
}
