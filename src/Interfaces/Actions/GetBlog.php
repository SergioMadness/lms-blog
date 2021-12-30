<?php namespace professionalweb\lms\Blog\Interfaces\Actions;

use professionalweb\lms\Common\Interfaces\Action;

/**
 * Interface for action to get blog
 * @package professionalweb\lms\Blog\Interfaces\Actions
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