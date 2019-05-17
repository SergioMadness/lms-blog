<?php namespace professionalweb\LMS\Blog\Actions\Local;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use professionalweb\LMS\Blog\Models\Blog;
use Symfony\Component\HttpFoundation\Response;
use professionalweb\LMS\Common\Traits\UseRequest;
use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use professionalweb\LMS\Common\Exceptions\ErrorsException;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\Blog\Interfaces\Actions\UpdateBlog as IUpdateBlog;

/**
 * Action to update blog
 * @package professionalweb\LMS\Blog\Actions\Local
 */
class UpdateBlog implements IUpdateBlog
{
    use UseRequest, UseBlogRepository;

    /**
     * @var int
     */
    private $id;

    public function __construct(Request $request, BlogRepository $blogRepository)
    {
        $this->setRequest($request)->setBlogRepository($blogRepository);
    }

    /**
     * @return mixed
     * @throws ErrorsException
     */
    public function run()
    {
        $request = $this->getRequest();
        $validator = $this->getValidator($request);
        if ($validator->fails()) {
            throw new ErrorsException($validator->errors()->all(), '', Response::HTTP_BAD_REQUEST);
        }

        $repository = $this->getBlogRepository();
        $model = $repository->model($this->getId());
        if ($model === null) {
            throw new NotFoundHttpException(trans('Blog::blog.blog-not-found'));
        }

        $repository->fill($model, $request->all());
        $repository->save($model);

        return $model;
    }

    /**
     * Get validator
     *
     * @param Request $request
     *
     * @return Validator
     */
    protected function getValidator(Request $request): Validator
    {
        $validator = ValidatorFacade::make($request->all(), [
            'title'   => 'sometimes|required|max:255',
            'body'    => 'sometimes|required',
            'preview' => 'sometimes|required',
        ]);

        return $validator;
    }

    /**
     * Set blog id
     *
     * @param string $id
     *
     * @return IUpdateBlog
     */
    public function setId(string $id): IUpdateBlog
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