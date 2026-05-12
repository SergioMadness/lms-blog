<?php

declare(strict_types=1);

namespace professionalweb\lms\Blog\Repositories\Local;

use professionalweb\lms\Blog\Models\Blog;
use professionalweb\lms\Common\Abstractions\BaseRepository;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;

/**
 * Topics repository
 */
class BlogRepository extends BaseRepository implements IBlogRepository
{
    public function __construct()
    {
        $this->setModelClass(Blog::class);
    }

    /**
     * Get Blog model by uri_code
     */
    public function getByUri(string $uriCode): ?Blog
    {
        return $this->getQuery()->where('uri_code', $uriCode)->first();
    }
}