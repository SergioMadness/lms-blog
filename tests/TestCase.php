<?php namespace professionalweb\lms\Blog\Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use professionalweb\lms\Common\Exceptions\Handler;
use professionalweb\lms\Blog\Providers\PackageProvider;
use professionalweb\lms\SAAS\Providers\PackageProvider as SaasPackageProvider;
use professionalweb\lms\Common\Providers\PackageProvider as CommonPackageProvider;

/**
 * Base test case
 * @package professionalweb\lms\Blog\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [PackageProvider::class, SaasPackageProvider::class, CommonPackageProvider::class];
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