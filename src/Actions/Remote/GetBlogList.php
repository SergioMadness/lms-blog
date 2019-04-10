<?php namespace professionalweb\LMS\Blog\Actions\Remote;

use Illuminate\Http\Request;
use professionalweb\LMS\Blog\Traits\UseBlogRepository;
use professionalweb\LMS\Common\Interfaces\Services\Balancer;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository;
use professionalweb\LMS\Common\Interfaces\Services\ModelFillService;
use professionalweb\LMS\Common\Interfaces\Services\RemoteDataService;
use professionalweb\LMS\Blog\Actions\Remote\RemoteAction as ARemoteAction;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlogList as IGetBlogList;

/**
 * Action to get city list from remote service
 * @package professionalweb\LMS\Blog\Actions\Remote
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