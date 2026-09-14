<?php namespace professionalweb\lms\Blog\Interfaces\Transformers;

use Illuminate\Support\Collection;
use professionalweb\lms\Blog\Models\Blog;

/**
 * Blog model transformer
 */
interface BlogTransformer
{
    /**
     * Transform blog
     */
    public function transform(Blog $blog): array;

    /**
     * Transform blog model to minimum info
     */
    public function transformMinimal(Blog $blog): array;

    /**
     * Transform collection of blog
     */
    public function transformCollection(Collection $collection): Collection;

    /**
     * Transform collection of blog (minimum info)
     */
    public function transformCollectionMinimal(Collection $collection): Collection;
}