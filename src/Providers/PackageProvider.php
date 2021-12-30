<?php namespace professionalweb\lms\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\lms\Blog\Actions\Local\GetBlog;
use professionalweb\lms\Blog\Actions\Local\StoreBlog;
use professionalweb\lms\Blog\Actions\Local\RemoveBlog;
use professionalweb\lms\Blog\Actions\Local\UpdateBlog;
use professionalweb\lms\Blog\Actions\Local\GetBlogList;
use professionalweb\lms\Blog\Repositories\Local\BlogRepository;
use professionalweb\lms\Blog\Transformers\BlogTransformer;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlog as IGetBlog;
use professionalweb\lms\Blog\Actions\Remote\GetBlog as GetBlogRemote;
use professionalweb\lms\Blog\Interfaces\Actions\StoreBlog as IStoreBlog;
use professionalweb\lms\Blog\Actions\Remote\StoreBlog as StoreBlogRemote;
use professionalweb\lms\Blog\Interfaces\Actions\UpdateBlog as IUpdateBlog;
use professionalweb\lms\Blog\Interfaces\Actions\RemoveBlog as IRemoveBlog;
use professionalweb\lms\Blog\Actions\Remote\RemoveBlog as RemoveBlogRemote;
use professionalweb\lms\Blog\Actions\Remote\UpdateBlog as UpdateBlogRemote;
use professionalweb\lms\Blog\Interfaces\Actions\GetBlogList as IGetBlogList;
use professionalweb\lms\Blog\Actions\Remote\GetBlogList as GetBlogListRemote;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;
use professionalweb\lms\Blog\Interfaces\Transformers\BlogTransformer as IBlogTransformer;

class PackageProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'Blog');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register(): void
    {
        if (config('modules.blog.remote', false)) {
            $this->app->bind(IGetBlog::class, GetBlogRemote::class);
            $this->app->bind(IStoreBlog::class, StoreBlogRemote::class);
            $this->app->bind(IUpdateBlog::class, UpdateBlogRemote::class);
            $this->app->bind(IRemoveBlog::class, RemoveBlogRemote::class);
            $this->app->bind(IGetBlogList::class, GetBlogListRemote::class);
        } else {
            $this->app->bind(IGetBlog::class, GetBlog::class);
            $this->app->bind(IStoreBlog::class, StoreBlog::class);
            $this->app->bind(IUpdateBlog::class, UpdateBlog::class);
            $this->app->bind(IRemoveBlog::class, RemoveBlog::class);
            $this->app->bind(IGetBlogList::class, GetBlogList::class);
        }

        $this->app->singleton(IBlogRepository::class, BlogRepository::class);
        $this->app->singleton(IBlogTransformer::class, BlogTransformer::class);
    }
}