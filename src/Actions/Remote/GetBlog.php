<?php namespace professionalweb\LMS\Blog\Actions\Remote;

use professionalweb\LMS\Blog\Interfaces\Actions\GetBlog as IGetBlog;

/**
 * Action to get blog
 * @package professionalweb\LMS\Blog\Actions\Remote
 */
class GetBlog extends StoreBlog implements IGetBlog
{
    /**
     * Set blog id
     *
     * @param int $id
     *
     * @return IGetBlog
     */
    public function setId(int $id): IGetBlog
    {
        return $this;
    }
}