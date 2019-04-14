<?php namespace professionalweb\LMS\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\LMS\Blog\Actions\Local\GetBlog;
use professionalweb\LMS\Blog\Actions\Local\StoreBlog;
use professionalweb\LMS\Blog\Actions\Local\RemoveBlog;
use professionalweb\LMS\Blog\Actions\Local\UpdateBlog;
use professionalweb\LMS\Blog\Actions\Local\GetBlogList;
use professionalweb\LMS\Blog\Repositories\Local\BlogRepository;
use professionalweb\LMS\Blog\Transformers\BlogTransformer;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlog as IGetBlog;
use professionalweb\LMS\Blog\Actions\Remote\GetBlog as GetBlogRemote;
use professionalweb\LMS\Blog\Interfaces\Actions\StoreBlog as IStoreBlog;
use professionalweb\LMS\Blog\Actions\Remote\StoreBlog as StoreBlogRemote;
use professionalweb\LMS\Blog\Interfaces\Actions\UpdateBlog as IUpdateBlog;
use professionalweb\LMS\Blog\Interfaces\Actions\RemoveBlog as IRemoveBlog;
use professionalweb\LMS\Blog\Actions\Remote\RemoveBlog as RemoveBlogRemote;
use professionalweb\LMS\Blog\Actions\Remote\UpdateBlog as UpdateBlogRemote;
use professionalweb\LMS\Blog\Interfaces\Actions\GetBlogList as IGetBlogList;
use professionalweb\LMS\Blog\Actions\Remote\GetBlogList as GetBlogListRemote;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;
use professionalweb\LMS\Blog\Interfaces\Transformers\BlogTransformer as IBlogTransformer;

class PackageProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'Blog');
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