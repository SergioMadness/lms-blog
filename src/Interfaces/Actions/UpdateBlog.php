<?php namespace professionalweb\lms\Blog\Interfaces\Actions;

use professionalweb\lms\Common\Interfaces\Action;

/**
 * Interface for action to update blog
 * @package professionalweb\lms\Blog\Interfaces\Actions
 */
interface UpdateBlog extends Action
{
    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return UpdateBlog
     */
    public function setId(string $id): self;
}