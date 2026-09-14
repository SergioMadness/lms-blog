<?php namespace professionalweb\lms\Blog\Http\Controllers\B2C;

use Illuminate\Routing\Controller;
use professionalweb\lms\Blog\Traits\UseBlogTransformer;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlog;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlogList;
use professionalweb\lms\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Controller to work with topics
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