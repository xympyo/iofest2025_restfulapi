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
        // Prepare ratings as array, not Eloquent collection
        $ratings = $this->ratings ? $this->ratings->map(function ($item) {
            return [
                'user_id' => $item->id_user,
                'rating' => $item->rating,
                'comments' => $item->comments,
            ];
        })->toArray() : [];
        $average_rating = $this->ratings ? $this->ratings->pluck('rating')->avg() : null;
        $ratings_count = $this->ratings ? $this->ratings->count() : 0;

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
            'storybookCreator' => UserResource::collection($this->whenLoaded('get_creators')),
            'pages' => $this->whenLoaded('pages', function () {
                return $this->pages->map(function ($page) {
                    return [
                        'id' => $page->id,
                        'page_number' => $page->page_information,
                        'panels' => $page->panels->map(function ($panel) {
                            return [
                                'id' => $panel->id,
                                'panel_number' => $panel->panels_number,
                                'panel_contents' => $panel->panelContents->map(function ($content) {
                                    return [
                                        'id' => $content->id,
                                        'image' => $content->image,
                                        'top_text' => $content->top_text,
                                        'top_text_align' => $content->top_text_align,
                                        'middle_text' => $content->middle_text,
                                        'middle_text_align' => $content->middle_text_align,
                                        'bottom_text' => $content->bottom_text,
                                        'bottom_text_align' => $content->bottom_text_align,
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
            // Ratings summary
            'average_rating' => $average_rating,
            'ratings_count' => $ratings_count,
            'ratings' => $ratings,
        ];
    }
}
