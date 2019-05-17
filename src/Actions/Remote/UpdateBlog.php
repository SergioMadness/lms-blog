<?php namespace professionalweb\LMS\Blog\Actions\Remote;

use professionalweb\LMS\Blog\Interfaces\Actions\UpdateBlog as IUpdateBlog;

/**
 * Action to update blog
 * @package professionalweb\LMS\Blog\Actions\Remote
 */
class UpdateBlog extends StoreBlog implements IUpdateBlog
{
    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return IUpdateBlog
     */
    public function setId(string $id): IUpdateBlog
    {
        return $this;
    }
}