<?php namespace professionalweb\LMS\Blog\Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use professionalweb\LMS\Common\Exceptions\Handler;
use professionalweb\LMS\Blog\Providers\PackageProvider;

/**
 * Base test case
 * @package professionalweb\LMS\Blog\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [PackageProvider::class];
    }

    /**
     * Resolve application HTTP exception handler.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function resolveApplicationExceptionHandler($app)
    {
        $app->singleton(ExceptionHandler::class, Handler::class);
    }
}