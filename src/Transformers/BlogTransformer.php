<?php namespace professionalweb\lms\Blog\Transformers;

use Illuminate\Support\Collection;
use professionalweb\lms\Blog\Models\Blog;
use professionalweb\lms\Blog\Interfaces\Transformers\BlogTransformer as IBlogTransformer;

/**
 * Transformer to transform blog topic
 */
class BlogTransformer implements IBlogTransformer
{

    /**
     * Transform blog
     */
    public function transform(Blog $blog): array
    {
        return [
            'id'         => $blog->id,
            'title'      => $blog->title,
            'body'       => $blog->text,
            'preview'    => $blog->preview_text,
            'uri_code'   => $blog->uri_code,
            'popularity' => $blog->popularity,
        ];
    }

    /**
     * Transform blog model to minimum info
     */
    public function transformMinimal(Blog $blog): array
    {
        return [
            'id'         => $blog->id,
            'title'      => $blog->title,
            'preview'    => $blog->preview_text,
            'uri_code'   => $blog->uri_code,
            'popularity' => $blog->popularity,
        ];
    }

    /**
     * Transform collection of blog
     */
    public function transformCollection(Collection $collection): Collection
    {
        return $collection->map(function (Blog $item) {
            return $this->transform($item);
        });
    }

    /**
     * Transform collection of blog (minimum info)
     */
    public function transformCollectionMinimal(Collection $collection): Collection
    {
        return $collection->map(function (Blog $item) {
            return $this->transformMinimal($item);
        });
    }
}