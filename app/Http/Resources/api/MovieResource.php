<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            "title" => $this->title,
            "rank" => $this->type,
            "year" => $this->release_year,
            "rating" => $this->rating,
            "desc" => $this->description,
            "poster" =>  [
                'src' => $this->poster,
                'poster_name' => $this->title
            ],
        ];
    }
}
