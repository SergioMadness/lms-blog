<?php namespace professionalweb\LMS\Blog\Actions\Local;

use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlog as IGetBlog;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;

/**
 * Action to get blog
 * @package professionalweb\LMS\Blog\Actions\Local
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