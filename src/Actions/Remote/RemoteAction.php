<?php namespace professionalweb\LMS\Blog\Actions\Remote;

use Illuminate\Http\Request;
use professionalweb\LMS\Common\Traits\UseModelFiller;
use professionalweb\LMS\Common\Interfaces\Services\Balancer;
use professionalweb\LMS\Common\Interfaces\Services\ModelFillService;
use professionalweb\LMS\Common\Interfaces\Services\RemoteDataService;
use professionalweb\LMS\Common\Abstractions\RemoteAction as ARemoteAction;

/**
 * Class RemoteAction
 * @package professionalweb\LMS\Blog\Actions\Remote
 */
abstract class RemoteAction extends ARemoteAction
{
    use UseModelFiller;

    public function __construct(Request $request, RemoteDataService $remoteDataService, Balancer $balancer, ModelFillService $modelFillService)
    {
        parent::__construct($request, $remoteDataService, $balancer);

        $this->setFiller($modelFillService);
    }

    /**
     * Method returns services' urls
     *
     * @return array
     */
    protected function getServiceUrls(): array
    {
        return config('modules.blog.services', []);
    }
}