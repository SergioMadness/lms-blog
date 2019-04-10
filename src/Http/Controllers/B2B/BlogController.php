<?php namespace professionalweb\LMS\Blog\Http\Controllers\B2B;

use Illuminate\Routing\Controller;
use professionalweb\LMS\Blog\Traits\UseBlogTransformer;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlog;
use professionalweb\LMS\Blog\Interfaces\Actions\StoreBlog;
use professionalweb\LMS\Blog\Interfaces\Actions\RemoveBlog;
use professionalweb\LMS\Blog\Interfaces\Actions\UpdateBlog;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlogList;
use professionalweb\LMS\Blog\Interfaces\Transformers\BlogTransformer;

/**
 * Controller to work with topics
 * @package professionalweb\LMS\Blog\Http\Controllers\B2B
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

    /**
     * Store blog
     *
     * @param StoreBlog $storeBlog
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreBlog $storeBlog)
    {
        return response(
            $this->getBlogTransformer()->transform(
                $storeBlog->run()
            )
        );
    }

    /**
     * Update blog model
     *
     * @param int        $id
     * @param UpdateBlog $updateBlog
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(int $id, UpdateBlog $updateBlog)
    {
        return response(
            $this->getBlogTransformer()->transform(
                $updateBlog->setId($id)->run()
            )
        );
    }

    /**
     * Remove blog model
     *
     * @param int        $id
     * @param RemoveBlog $removeBlog
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(int $id, RemoveBlog $removeBlog)
    {
        return response(
            $this->getBlogTransformer()->transform(
                $removeBlog->setId($id)->run()
            )
        );
    }
}