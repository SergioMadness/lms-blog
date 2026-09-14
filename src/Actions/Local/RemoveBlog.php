<?php namespace professionalweb\lms\Blog\Actions\Local;

use professionalweb\lms\Blog\Traits\UseBlogRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\lms\Blog\Interfaces\Actions\RemoveBlog as IRemoveBlog;

/**
 * Action to remove blog
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
     */
    public function setId(string $id): IRemoveBlog
    {
        $this->blogId = $id;

        return $this;
    }

    /**
     * Get blog id
     */
    public function getBlogId(): string
    {
        return $this->blogId;
    }
}