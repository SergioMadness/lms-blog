<?php namespace professionalweb\LMS\Blog\Actions\Local;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use professionalweb\LMS\Common\Traits\UseRequest;
use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use professionalweb\LMS\Common\Exceptions\ErrorsException;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\Blog\Interfaces\Actions\StoreBlog as IStoreBlog;

/**
 * Action to store blog
 * @package professionalweb\LMS\Blog\Actions\Local
 */
class StoreBlog implements IStoreBlog
{
    use UseRequest, UseBlogRepository;

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
        $model = $repository->create($request->all());
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
            'title'        => 'required|max:255',
            'body'         => 'required',
            'preview'      => 'required',
            'uri_code'     => 'required',
            'is_active'    => 'boolean',
            'publish_date' => 'required|date',
        ]);

        return $validator;
    }
}