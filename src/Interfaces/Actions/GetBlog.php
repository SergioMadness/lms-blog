<?php namespace professionalweb\LMS\Blog\Interfaces\Actions;

use professionalweb\LMS\Common\Interfaces\Action;

/**
 * Interface for action to get blog
 * @package professionalweb\LMS\Blog\Interfaces\Actions
 */
interface GetBlog extends Action
{
    /**
     * Set blog
     *
     * @param string $id
     *
     * @return GetBlog
     */
    public function setId(string $id): self;
}