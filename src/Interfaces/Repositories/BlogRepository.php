<?php namespace professionalweb\LMS\Blog\Interfaces\Repositories;

use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Common\Interfaces\Repositories\Repository;

/**
 * Interface for topics repository
 * @package professionalweb\LMS\Blog\Interfaces\Repositories
 */
interface BlogRepository extends Repository
{
    /**
     * Create model
     *
     * @param array $attributes
     *
     * @return Blog
     */
    public function create(array $attributes = []): Blog;

    /**
     * Save model
     *
     * @param Blog $model
     *
     * @return bool
     */
    public function save(Blog $model): bool;

    /**
     * Remove model
     *
     * @param Blog $model
     *
     * @return bool
     */
    public function remove(Blog $model): bool;

    /**
     * Fill model
     *
     * @param Blog  $model
     * @param array $attributes
     *
     * @return Blog
     */
    public function fill(Blog $model, array $attributes = []): Blog;

    /**
     * Get model by id
     *
     * @param string|int $id
     *
     * @return Blog|null
     */
    public function model($id): ?Blog;
}