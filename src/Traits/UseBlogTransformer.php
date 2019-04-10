<?php namespace professionalweb\LMS\Blog\Traits;

use professionalweb\LMS\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Trait for classes use topic transformer
 * @package professionalweb\LMS\Blog\Traits
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