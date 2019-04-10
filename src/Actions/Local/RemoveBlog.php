<?php namespace professionalweb\LMS\Blog\Actions\Local;

use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\Blog\Interfaces\Actions\RemoveBlog as IRemoveBlog;

/**
 * Action to remove blog
 * @package professionalweb\LMS\Blog\Actions\Local
 */
class RemoveBlog implements IRemoveBlog
{
    use UseBlogRepository;

    /**
     * @var int
     */
    private $blogId;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->setBlogRepository($blogRepository);
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $repository = $this->getBlogRepository();
        $model = $repository->model($this->getBlogId());
        if ($model === null) {
            throw new NotFoundHttpException(trans('Blog::blog.blog-not-found'));
        }
        $repository->remove($model);

        return $model;
    }

    /**
     * Set blog id
     *
     * @param int $id
     *
     * @return IRemoveBlog
     */
    public function setId(int $id): IRemoveBlog
    {
        $this->blogId = $id;

        return $this;
    }

    /**
     * Get blog id
     *
     * @return int
     */
    public function getBlogId(): int
    {
        return $this->blogId;
    }
}