<?php namespace professionalweb\lms\Blog\Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use professionalweb\lms\Common\Exceptions\Handler;
use professionalweb\lms\Blog\Providers\PackageProvider;
use professionalweb\lms\SAAS\Providers\PackageProvider as SaasPackageProvider;
use professionalweb\lms\Common\Providers\PackageProvider as LmsCommonPackageProvider;

/**
 * Base test case
 * @package professionalweb\lms\Dictionary\Tests
 */
class TestCaseRemote extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [PackageProvider::class, LmsCommonPackageProvider::class, SaasPackageProvider::class];
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

    /**
     * Resolve application core configuration implementation.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function resolveApplicationConfiguration($app)
    {
        $app->make('Illuminate\Foundation\Bootstrap\LoadConfiguration')->bootstrap($app);

        \tap($this->getApplicationTimezone($app), function ($timezone) {
            !\is_null($timezone) && \date_default_timezone_set($timezone);
        });

        $app['config']['app.aliases'] = $this->resolveApplicationAliases($app);
        $app['config']['app.providers'] = $this->resolveApplicationProviders($app);

        $app['config']->set('modules.blog.remote', true);
        $app['config']->set('modules.blog.services', [
            $this->getDomain(),
        ]);
    }

    /**
     * Get base domain
     *
     * @return string
     */
    protected function getDomain(): string
    {
        return 'http://test.loc';
    }

    /**
     * Concat domain and uri
     *
     * @param string $uri
     *
     * @param array  $params
     *
     * @return string
     */
    protected function prepareUrl(string $uri, array $params = []): string
    {
        $result = rtrim($this->getDomain(), '/') . '/' . ltrim($uri, '/');

        foreach ($params as $key => $val) {
            $result = str_replace('{' . $key . '}', $val, $result);
        }

        return $result;
    }
}