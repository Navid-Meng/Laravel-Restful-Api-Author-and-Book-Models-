<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'authorId' => $this->author_id,
            'title' => $this->title,
            'publicationDate' => $this->publication_date,
            'genre' => $this->genre,
            'price' => $this->price,
            'summary' => $this->summary
        ];
    }
}
