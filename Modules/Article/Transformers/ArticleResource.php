<?php

namespace Modules\Article\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id' => $this->id,
            // 'article_category_id' => $this->article_category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'meta_description' => $this->meta_description,
            'cover' => $this->cover,
            'status' => $this->status,
            'publish_date' => $this->publish_date,
            'category' => new ArticleCategoryResource($this->whenLoaded('category')),
            'author' => new AuthorResource($this->whenLoaded('author')),
            'editor' => new AuthorResource($this->whenLoaded('editor')),
            // 'created_by' => $this->created_by,
            // 'updated_by' => $this->updated_by,
        ];
    }
}
