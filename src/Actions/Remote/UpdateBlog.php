<?php namespace professionalweb\lms\Blog\Actions\Remote;

use professionalweb\lms\Blog\Interfaces\Actions\UpdateBlog as IUpdateBlog;

/**
 * Action to update blog
 * @package professionalweb\lms\Blog\Actions\Remote
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