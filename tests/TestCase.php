<?php namespace professionalweb\lms\Blog\Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use professionalweb\lms\Common\Exceptions\Handler;
use professionalweb\lms\Blog\Providers\PackageProvider;
use professionalweb\lms\SAAS\Providers\PackageProvider as SaasPackageProvider;
use professionalweb\lms\Users\Interfaces\Services\PermissionService;
use professionalweb\lms\Common\Providers\PackageProvider as CommonPackageProvider;

/**
 * Base test case
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [PackageProvider::class, SaasPackageProvider::class, CommonPackageProvider::class];
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
}
