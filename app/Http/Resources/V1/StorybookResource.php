<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StorybookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'storybook_words' => $this->storybook_words,
            'readTime' => $this->read_time,
            'readCount' => $this->read_count,
            'pagesNumber' => $this->pages_number,
            'isApproved' => $this->is_approved,
            'idLanguage' => $this->id_language,
            'backgroundImage' => $this->background_image,
            'storybookProfile' => $this->storybook_profile,
            'createdAt' => $this->created_at,
        ];
    }
}
