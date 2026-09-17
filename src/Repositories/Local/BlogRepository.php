<?php

declare(strict_types=1);

namespace professionalweb\lms\Blog\Repositories\Local;

use Illuminate\Support\Collection;
use professionalweb\lms\Blog\Models\Blog;
use professionalweb\lms\Common\Abstractions\EntityRepository;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;

/**
 * Topics repository
 *
 * Topics belong to a website: they are checked by the website of the request, or by the company without one.
 */
class BlogRepository extends EntityRepository implements IBlogRepository
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

    /**
     * Walk over every post of the company
     *
     * @param callable(Blog): void $callback
     */
    public function eachOfCompany(int $companyId, callable $callback): void
    {
        Blog::query()
            ->where('company_id', $companyId)
            ->chunkById(200, static function (Collection $posts) use ($callback): void {
                foreach ($posts as $post) {
                    $callback($post);
                }
            });
    }
}
