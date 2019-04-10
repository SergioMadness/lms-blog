<?php namespace professionalweb\LMS\Blog\Interfaces\Transformers;

use Illuminate\Support\Collection;
use professionalweb\LMS\Blog\Models\Blog;

/**
 * Blog model transformer
 * @package professionalweb\LMS\Blog\Interfaces\Transformers
 */
interface BlogTransformer
{
    /**
     * Transform blog
     *
     * @param Blog $blog
     *
     * @return array
     */
    public function transform(Blog $blog): array;

    /**
     * Transform blog model to minimum info
     *
     * @param Blog $blog
     *
     * @return array
     */
    public function transformMinimal(Blog $blog): array;

    /**
     * Transform collection of blog
     *
     * @param Collection $collection
     *
     * @return Collection
     */
    public function transformCollection(Collection $collection): Collection;

    /**
     * Transform collection of blog (minimum info)
     *
     * @param Collection $collection
     *
     * @return Collection
     */
    public function transformCollectionMinimal(Collection $collection): Collection;
}