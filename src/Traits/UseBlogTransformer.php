<?php namespace professionalweb\lms\Blog\Traits;

use professionalweb\lms\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Trait for classes use topic transformer
 */
trait UseBlogTransformer
{
    /**
     * @var BlogTransformer
     */
    private $blogTransformer;

    
    public function getBlogTransformer(): BlogTransformer
    {
        return $this->blogTransformer;
    }

    /**
     *
     * @return $this
     */
    public function setBlogTransformer(BlogTransformer $blogTransformer): self
    {
        $this->blogTransformer = $blogTransformer;

        return $this;
    }
}