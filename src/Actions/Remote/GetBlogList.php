<?php namespace professionalweb\lms\Blog\Actions\Remote;

use Illuminate\Http\Request;
use professionalweb\lms\Blog\Traits\UseBlogRepository;
use professionalweb\lms\Common\Interfaces\Services\Balancer;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\lms\Common\Interfaces\Services\ModelFillService;
use professionalweb\lms\Common\Interfaces\Services\RemoteDataService;
use professionalweb\lms\Blog\Actions\Remote\RemoteAction as ARemoteAction;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlogList as IGetBlogList;

/**
 * Action to get city list from remote service
 * @package professionalweb\lms\Blog\Actions\Remote
 */
class GetBlogList extends ARemoteAction implements IGetBlogList
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

        $items = [];
        foreach ($result as $item) {
            $items[] = $this->getFiller()->fill(
                $this->getBlogRepository()->create(),
                $item
            );
        }

        return $items;
    }
}