<?php namespace professionalweb\LMS\Blog\Repositories\Local;

use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Common\Abstractions\BaseRepository;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;

/**
 * Topics repository
 * @package professionalweb\LMS\Blog\Repositories
 */
class BlogRepository extends BaseRepository implements IBlogRepository
{
    public function __construct()
    {
        $this->setModelClass(Blog::class);
    }
}