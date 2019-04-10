<?php namespace professionalweb\LMS\Blog\Repositories;

use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Common\Abstractions\BaseRepository;
use professionalweb\LMS\Blog\Interfaces\Repositories\BlogRepository as IBlogRepository;

/**
 * Topics repository
 * @package professionalweb\LMS\Blog\Repositories
 */
class BlogRepository extends BaseRepository implements IBlogRepository
{
    public function __construct()
    {
        $this->setModelClass(Blog::class);
    }

    /**
     * Create model
     *
     * @param array $attributes
     *
     * @return Blog
     */
    public function create(array $attributes = []): Blog
    {
        return new Blog($this->prepareAttributes($attributes));
    }

    /**
     * Prepare attributes
     *
     * @param array $attributes
     *
     * @return array
     */
    protected function prepareAttributes(array $attributes): array
    {
        if (isset($attributes['preview'])) {
            $attributes['preview_text'] = $attributes['preview'];
        }

        return $attributes;
    }

    /**
     * Save model
     *
     * @param Blog $model
     *
     * @return bool
     */
    public function save(Blog $model): bool
    {
        return $model->save();
    }

    /**
     * Remove model
     *
     * @param Blog $model
     *
     * @return bool
     * @throws \Exception
     */
    public function remove(Blog $model): bool
    {
        return $model->delete();
    }

    /**
     * Fill model
     *
     * @param Blog  $model
     * @param array $attributes
     *
     * @return Blog
     */
    public function fill(Blog $model, array $attributes = []): Blog
    {
        return $model->fill($this->prepareAttributes($attributes));
    }

    /**
     * Get model by id
     *
     * @param string|int $id
     *
     * @return Blog|null
     */
    public function model($id): ?Blog
    {
        return Blog::query()->find($id);
    }
}