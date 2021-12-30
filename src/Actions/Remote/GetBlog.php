<?php namespace professionalweb\lms\Blog\Actions\Remote;

use professionalweb\lms\Blog\Interfaces\Actions\GetBlog as IGetBlog;

/**
 * Action to get blog
 * @package professionalweb\lms\Blog\Actions\Remote
 */
class GetBlog extends StoreBlog implements IGetBlog
{
    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return IGetBlog
     */
    public function setId(string $id): IGetBlog
    {
        return $this;
    }
}