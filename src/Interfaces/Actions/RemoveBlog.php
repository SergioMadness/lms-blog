<?php namespace professionalweb\lms\Blog\Interfaces\Actions;

use professionalweb\lms\Common\Interfaces\Action;

/**
 * Interface for action to remove blog
 */
interface RemoveBlog extends Action
{
    /**
     * Set blog id
     */
    public function setId(string $id): self;
}