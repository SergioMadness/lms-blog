<?php namespace professionalweb\lms\Blog\Repositories\Remote;

use professionalweb\lms\Common\Abstractions\BaseRemoteRepository as CommonBaseRemoteRepository;

/**
 * Base repository to work with remote services
 */
abstract class BaseRemoteRepository extends CommonBaseRemoteRepository
{
    /**
     * Method returns services' urls
     */
    protected function getServiceUrls(): array
    {
        return config('modules.news.services', []);
    }
}