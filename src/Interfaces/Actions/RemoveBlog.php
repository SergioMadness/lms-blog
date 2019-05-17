<?php namespace professionalweb\LMS\Blog\Interfaces\Actions;

use professionalweb\LMS\Common\Interfaces\Action;

/**
 * Interface for action to remove blog
 * @package professionalweb\LMS\Blog\Interfaces\Actions
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