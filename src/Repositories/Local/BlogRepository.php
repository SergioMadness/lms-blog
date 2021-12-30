<?php namespace professionalweb\lms\Blog\Repositories\Local;

use professionalweb\lms\Blog\Models\Blog;
use professionalweb\lms\Common\Abstractions\BaseRepository;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;

/**
 * Topics repository
 * @package professionalweb\lms\Blog\Repositories
 */
class BlogRepository extends BaseRepository implements IBlogRepository
{
    public function __construct()
    {
        $this->setModelClass(Blog::class);
    }
}