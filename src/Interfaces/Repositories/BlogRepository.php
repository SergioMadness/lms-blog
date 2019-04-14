<?php namespace professionalweb\LMS\Blog\Interfaces\Repositories;

use Illuminate\Support\Collection;
use professionalweb\LMS\Blog\Models\Blog;
use professionalweb\LMS\Common\Interfaces\Repositories\Repository;

/**
 * Interface for topics repository
 * @package professionalweb\LMS\Blog\Interfaces\Repositories
 *
 * @method Blog create(array $attributes = [])
 * @method Blog save(Blog $model)
 * @method bool remove(Blog $model)
 * @method Blog fill(Blog $model, array $attributes = [])
 * @method ?City model($id)
 * @method Collection get(array $filters = [], array $sort = [], ?int $limit = null, ?int $offset = null)
 * @method int count(array $filters = [])
 */
interface BlogRepository extends Repository
{

}