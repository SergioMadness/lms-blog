<?php namespace professionalweb\lms\Blog\Interfaces\Actions;

use professionalweb\lms\Common\Interfaces\Action;

/**
 * Interface for action to get blog
 */
interface GetBlog extends Action
{
    /**
     * Set blog
     *
     * @return GetBlog
     */
    public function setId(string $id): self;
}