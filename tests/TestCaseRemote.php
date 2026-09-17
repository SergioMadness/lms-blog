<?php namespace professionalweb\lms\Blog\Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use professionalweb\lms\Common\Exceptions\Handler;
use professionalweb\lms\Blog\Providers\PackageProvider;
use professionalweb\lms\SAAS\Providers\PackageProvider as SaasPackageProvider;
use professionalweb\lms\Users\Interfaces\Services\PermissionService;
use professionalweb\lms\Common\Providers\PackageProvider as LmsCommonPackageProvider;

/**
 * Base test case
 */
class TestCaseRemote extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [PackageProvider::class, LmsCommonPackageProvider::class, SaasPackageProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app->singleton(PermissionService::class, static function () {
            return new class implements PermissionService {
                private array $permissions = [];

                public function registerPermissions(array $permissions, string $namespace = 'root'): PermissionService
                {
                    $this->permissions[$namespace] = array_merge($this->permissions[$namespace] ?? [], $permissions);

                    return $this;
                }

                public function getPermissions(): array
                {
                    return $this->permissions;
                }

                public function can(\professionalweb\lms\Users\Models\User\User $user, string $ability, array $arguments = []): bool
                {
                    return true;
                }
            };
        });
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
     */
    protected function getDomain(): string
    {
        return 'http://test.loc';
    }

    /**
     * Concat domain and uri
     *
     * @param array<string, mixed>  $params
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
