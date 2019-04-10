<?php namespace professionalweb\LMS\Blog\Transformers;

use Illuminate\Support\Collection;
use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Blog\Interfaces\Transformers\BlogTransformer as IBlogTransformer;

/**
 * Transformer to transform blog topic
 * @package professionalweb\LMS\Blog\Transformers
 */
class BlogTransformer implements IBlogTransformer
{

    /**
     * Transform blog
     *
     * @param Blog $blog
     *
     * @return array
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
     *
     * @param Blog $blog
     *
     * @return array
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
     *
     * @param Collection $collection
     *
     * @return Collection
     */
    public function transformCollection(Collection $collection): Collection
    {
        return $collection->map(function (Blog $item) {
            return $this->transform($item);
        });
    }

    /**
     * Transform collection of blog (minimum info)
     *
     * @param Collection $collection
     *
     * @return Collection
     */
    public function transformCollectionMinimal(Collection $collection): Collection
    {
        return $collection->map(function (Blog $item) {
            return $this->transformMinimal($item);
        });
    }
}