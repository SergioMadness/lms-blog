<?php namespace professionalweb\lms\Blog\Actions\Remote;

use professionalweb\lms\Blog\Interfaces\Actions\RemoveBlog as IRemoveBlog;

/**
 * Action to remove blog
 */
class RemoveBlog extends StoreBlog implements IRemoveBlog
{
    /**
     * Set blog id
     */
    public function setId(string $id): IRemoveBlog
    {
        return $this;
    }
}