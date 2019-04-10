<?php namespace professionalweb\LMS\Blog\Actions\Local;

use Illuminate\Http\Request;
use professionalweb\LMS\Common\Traits\UseRequest;
use professionalweb\LMS\Common\Traits\HasPagination;
use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use professionalweb\LMS\Common\Interfaces\WithPagination;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlogList as IGetBlogList;

/**
 * Action to get blog list
 * @package professionalweb\LMS\Blog\Actions\Local
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

        return $this->getBlogRepository()->get($filter, ['name' => 'asc'], $this->getLimit($request), $this->getOffset($request));
    }
}