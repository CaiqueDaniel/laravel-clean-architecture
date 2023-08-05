<?php

namespace App\Http\Requests;

use Core\Modules\Post\Dtos\PostDTO;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'article' => 'required|string|max:255',
            'category' => 'numeric'
        ];
    }

    public function toDTO(): PostDTO
    {
        return new PostDTO(
            $this->get('title'),
            $this->get('subtitle'),
            $this->get('article'),
            $this->get('category')
        );
    }
}
