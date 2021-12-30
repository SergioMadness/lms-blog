<?php namespace professionalweb\lms\Blog\Traits;

use professionalweb\lms\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Trait for classes use topic transformer
 * @package professionalweb\lms\Blog\Traits
 */
trait UseBlogTransformer
{
    /**
     * @var BlogTransformer
     */
    private $blogTransformer;

    /**
     * @return BlogTransformer
     */
    public function getBlogTransformer(): BlogTransformer
    {
        return $this->blogTransformer;
    }

    /**
     * @param BlogTransformer $blogTransformer
     *
     * @return $this
     */
    public function setBlogTransformer(BlogTransformer $blogTransformer): self
    {
        $this->blogTransformer = $blogTransformer;

        return $this;
    }
}