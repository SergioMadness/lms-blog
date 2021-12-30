<?php namespace professionalweb\lms\Blog\Actions\Local;

use professionalweb\lms\Blog\Traits\UseBlogRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlog as IGetBlog;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;

/**
 * Action to get blog
 * @package professionalweb\lms\Blog\Actions\Local
 */
class GetBlog implements IGetBlog
{
    use UseBlogRepository;

    /**
     * @var int
     */
    private $id;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->setBlogRepository($blogRepository);
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $model = $this->getBlogRepository()->model($this->getId());
        if ($model === null) {
            throw new NotFoundHttpException(trans('Blog::blog.topic-not-found'));
        }

        return $model;
    }

    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return IGetBlog
     */
    public function setId(string $id): IGetBlog
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get blog id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}