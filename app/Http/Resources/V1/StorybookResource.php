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
            'genres' => $this->genres->pluck('genre_name'),
'pages' => $this->whenLoaded('pages', function () {
    return $this->pages->map(function ($page) {
        return [
            'id' => $page->id,
            'page_number' => $page->page_number,
            'panels' => $page->panels->map(function ($panel) {
                return [
                    'id' => $panel->id,
                    'panel_number' => $panel->panel_number,
                    'panel_contents' => $panel->panelContents->map(function ($content) {
                        return [
                            'id' => $content->id,
                            'type' => $content->type,
                            'content' => $content->content,
                        ];
                    }),
                ];
            }),
        ];
    });
}),
            'idLanguage' => $this->id_language,
            'backgroundImage' => $this->background_image,
            'storybookProfile' => $this->storybook_profile,
            'createdAt' => $this->created_at,
        ];
    }
}
