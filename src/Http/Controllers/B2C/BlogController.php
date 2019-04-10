<?php namespace professionalweb\LMS\Blog\Http\Controllers\B2C;

use Illuminate\Routing\Controller;
use professionalweb\LMS\Blog\Traits\UseBlogTransformer;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlog;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlogList;
use professionalweb\LMS\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Controller to work with topics
 * @package professionalweb\LMS\Blog\Http\Controllers\B2C
 */
class BlogController extends Controller
{
    use UseBlogTransformer;

    public function __construct(BlogTransformer $blogTransformer)
    {
        $this->setBlogTransformer($blogTransformer);
    }

    /**
     * Get blog list
     *
     * @param GetBlogList $getBlogListAction
     *
     * @return mixed
     */
    public function index(GetBlogList $getBlogListAction)
    {
        return response(
            $this->getBlogTransformer()->transformCollectionMinimal(
                collect($getBlogListAction->run())
            )
        );
    }

    /**
     * Get single blog
     *
     * @param int     $id
     * @param GetBlog $getBlogAction
     *
     * @return mixed
     */
    public function view(int $id, GetBlog $getBlogAction)
    {
        return response(
            $this->getBlogTransformer()->transform(
                $getBlogAction->setId($id)->run()
            )
        );
    }
}