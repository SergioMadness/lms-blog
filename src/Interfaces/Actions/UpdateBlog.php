<?php namespace professionalweb\lms\Blog\Interfaces\Actions;

use professionalweb\lms\Common\Interfaces\Action;

/**
 * Interface for action to update blog
 */
interface UpdateBlog extends Action
{
    /**
     * Set blog id
     *
     * @return UpdateBlog
     */
    public function setId(string $id): self;
}