<?php namespace professionalweb\LMS\Blog\Actions\Remote;

use professionalweb\LMS\Blog\Interfaces\Actions\RemoveBlog as IRemoveBlog;

/**
 * Action to remove blog
 * @package professionalweb\LMS\Blog\Actions\Remote
 */
class RemoveBlog extends StoreBlog implements IRemoveBlog
{
    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return IRemoveBlog
     */
    public function setId(string $id): IRemoveBlog
    {
        return $this;
    }
}