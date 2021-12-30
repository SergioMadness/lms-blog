<?php namespace professionalweb\lms\Blog\Actions\Local;

use Illuminate\Http\Request;
use professionalweb\lms\Common\Traits\UseRequest;
use professionalweb\lms\Common\Traits\HasPagination;
use professionalweb\lms\Blog\Traits\UseBlogRepository;
use professionalweb\lms\Common\Interfaces\WithPagination;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlogList as IGetBlogList;

/**
 * Action to get blog list
 * @package professionalweb\lms\Blog\Actions\Local
 */
class GetBlogList implements IGetBlogList, WithPagination
{
    use UseRequest, UseBlogRepository, HasPagination;

    public function __construct(Request $request, BlogRepository $blogRepository)
    {
        $this->setRequest($request)->setBlogRepository($blogRepository);
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $filter = [];
        $request = $this->getRequest();

        return $this->getBlogRepository()->get($filter, ['publish_date' => 'desc'], $this->getLimit($request), $this->getOffset($request));
    }
}