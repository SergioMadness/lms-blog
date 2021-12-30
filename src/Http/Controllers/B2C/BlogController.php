<?php namespace professionalweb\lms\Blog\Http\Controllers\B2C;

use Illuminate\Routing\Controller;
use professionalweb\lms\Blog\Traits\UseBlogTransformer;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlog;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlogList;
use professionalweb\lms\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Controller to work with topics
 * @package professionalweb\lms\Blog\Http\Controllers\B2C
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
     * @param string  $id
     * @param GetBlog $getBlogAction
     *
     * @return mixed
     */
    public function view(string $id, GetBlog $getBlogAction)
    {
        return response(
            $this->getBlogTransformer()->transform(
                $getBlogAction->setId($id)->run()
            )
        );
    }
}