<?php

declare(strict_types=1);

namespace professionalweb\lms\Blog\Services\FileUsage;

use Illuminate\Database\Eloquent\Model;
use professionalweb\lms\Blog\Models\Blog;
use professionalweb\lms\Storage\Interfaces\FileUsageSource;
use professionalweb\lms\Blog\Interfaces\Repositories\BlogRepository;

/**
 * Files used by blog posts: the cover and pictures in the text
 */
class BlogFileUsageSource implements FileUsageSource
{
    public const TYPE = 'blog-topic';

    public function __construct(
        private readonly BlogRepository $blogRepository
    )
    {
    }

    public function getEntityType(): string
    {
        return self::TYPE;
    }

    public function getLabel(): string
    {
        return 'Blog::files.usage.topic';
    }

    public function getModelClass(): string
    {
        return Blog::class;
    }

    public function getEntityId(Model $model): string
    {
        return (string)$model->getKey();
    }

    public function getCompanyId(Model $model): ?int
    {
        return $model->company_id === null ? null : (int)$model->company_id;
    }

    public function getReferences(Model $model): array
    {
        return $model->getAttributes();
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function eachModel(int $companyId, callable $callback): void
    {
        $this->blogRepository->eachOfCompany($companyId, $callback);
    }
}
