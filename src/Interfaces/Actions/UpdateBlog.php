<?php namespace professionalweb\LMS\Blog\Interfaces\Actions;

use professionalweb\LMS\Common\Interfaces\Action;

/**
 * Interface for action to update blog
 * @package professionalweb\LMS\Blog\Interfaces\Actions
 */
interface UpdateBlog extends Action
{
    /**
     * Set blog id
     *
     * @param int $id
     *
     * @return UpdateBlog
     */
    public function setId(int $id): self;
}