<?php namespace professionalweb\lms\Blog\Interfaces\Actions;

use professionalweb\lms\Common\Interfaces\Action;

/**
 * Interface for action to remove blog
 * @package professionalweb\lms\Blog\Interfaces\Actions
 */
interface RemoveBlog extends Action
{
    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self;
}