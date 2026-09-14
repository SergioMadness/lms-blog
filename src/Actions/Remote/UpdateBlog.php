<?php namespace professionalweb\lms\Blog\Actions\Remote;

use professionalweb\lms\Blog\Interfaces\Actions\UpdateBlog as IUpdateBlog;

/**
 * Action to update blog
 */
class UpdateBlog extends StoreBlog implements IUpdateBlog
{
    /**
     * Set blog id
     */
    public function setId(string $id): IUpdateBlog
    {
        return $this;
    }
}