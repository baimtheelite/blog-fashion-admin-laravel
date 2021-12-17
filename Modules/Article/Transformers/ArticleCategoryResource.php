<?php

namespace Modules\Article\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }
}
