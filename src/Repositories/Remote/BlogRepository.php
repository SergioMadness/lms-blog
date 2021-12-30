<?php namespace professionalweb\lms\Blog\Repositories\Remote;

use professionalweb\lms\Blog\Models\Blog;
use professionalweb\lms\Blog\Interfaces\ApiMethods;
use professionalweb\lms\Common\Interfaces\Services\Balancer;
use professionalweb\lms\Common\Interfaces\Services\ModelFillService;
use professionalweb\lms\Common\Interfaces\Services\RemoteDataService;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;

/**
 * Topics repository
 * @package professionalweb\lms\Blog\Repositories\Remote
 */
class BlogRepository extends BaseRemoteRepository implements IBlogRepository
{
    public function __construct(RemoteDataService $remoteDataService, Balancer $balancer,
                                ModelFillService $modelFillService)
    {
        parent::__construct($remoteDataService, $balancer, $modelFillService);

        $this->setModelClass(Blog::class);
    }

    /**
     * Get list method name
     *
     * @return string
     */
    protected function getListMethod(): string
    {
        return ApiMethods::API_METHOD_BLOG_LIST;
    }

    /**
     * Get method to save data
     *
     * @return string
     */
    protected function getSaveMethod(): string
    {
        return ApiMethods::API_METHOD_STORE_BLOG;
    }

    /**
     * Get method to remove data
     *
     * @return string
     */
    protected function getRemoveMethod(): string
    {
        return ApiMethods::API_METHOD_REMOVE_BLOG;
    }

    /**
     * Get find method
     *
     * @return string
     */
    protected function getFindMethod(): string
    {
        return ApiMethods::API_METHOD_GET_BLOG;
    }
}