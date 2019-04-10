<?php namespace professionalweb\LMS\Blog\Traits;

use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;

/**
 * Trait for classes use blog repository
 * @package professionalweb\LMS\Blog\Traits
 */
trait UseBlogRepository
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * @return BlogRepository
     */
    public function getBlogRepository(): BlogRepository
    {
        return $this->blogRepository;
    }

    /**
     * @param BlogRepository $blogRepository
     *
     * @return $this
     */
    public function setBlogRepository(BlogRepository $blogRepository): self
    {
        $this->blogRepository = $blogRepository;

        return $this;
    }
}