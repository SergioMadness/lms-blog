<?php namespace professionalweb\LMS\Blog\Actions\Remote;

use Illuminate\Http\Request;
use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use professionalweb\LMS\Common\Interfaces\Services\Balancer;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\Common\Interfaces\Services\ModelFillService;
use professionalweb\LMS\Common\Interfaces\Services\RemoteDataService;
use professionalweb\LMS\Blog\Interfaces\Actions\StoreBlog as IStoreBlog;
use professionalweb\LMS\Blog\Actions\Remote\RemoteAction as ARemoteAction;

/**
 * Class for remote action
 * @package professionalweb\LMS\Blog\Actions\Remote
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