<?php namespace professionalweb\lms\Blog\Traits;

use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;

/**
 * Trait for classes use blog repository
 */
trait UseBlogRepository
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    
    public function getBlogRepository(): BlogRepository
    {
        return $this->blogRepository;
    }

    /**
     *
     * @return $this
     */
    public function setBlogRepository(BlogRepository $blogRepository): self
    {
        $this->blogRepository = $blogRepository;

        return $this;
    }
}