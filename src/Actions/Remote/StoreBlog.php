<?php namespace professionalweb\lms\Blog\Actions\Remote;

use Illuminate\Http\Request;
use professionalweb\lms\Blog\Traits\UseBlogRepository;
use professionalweb\lms\Common\Interfaces\Services\Balancer;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\lms\Common\Interfaces\Services\ModelFillService;
use professionalweb\lms\Common\Interfaces\Services\RemoteDataService;
use professionalweb\lms\Blog\Interfaces\Actions\StoreBlog as IStoreBlog;
use professionalweb\lms\Blog\Actions\Remote\RemoteAction as ARemoteAction;

/**
 * Class for remote action
 * @package professionalweb\lms\Blog\Actions\Remote
 */
class StoreBlog extends ARemoteAction implements IStoreBlog
{
    use UseBlogRepository;

    public function __construct(Request $request, RemoteDataService $remoteDataService, Balancer $balancer,
                                ModelFillService $modelFillService, BlogRepository $blogRepository)
    {
        parent::__construct($request, $remoteDataService, $balancer, $modelFillService);

        $this->setBlogRepository($blogRepository);
    }

    public function run()
    {
        $result = parent::run();

        return $this->getFiller()->fill(
            $this->getBlogRepository()->create(),
            $result
        );
    }
}