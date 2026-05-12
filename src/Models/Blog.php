<?php

declare(strict_types=1);

namespace professionalweb\lms\Blog\Models;

use Carbon\Carbon;
use professionalweb\lms\Common\Abstractions\UUIDModel;

/**
 * Class CampusKnowledge
 *
 * @property string $id
 * @property bool   $active
 * @property string $cover_id
 * @property int    $user_id
 * @property string $title
 * @property string $preview_text
 * @property string $text
 * @property string $blocked_text
 * @property int    $language_id
 * @property string $permission
 * @property int    $company_id
 * @property Carbon $publish_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property string $uri_code
 * @property int    $popularity
 * @property bool   $show_author
 * @property bool   $enable_comments
 * @property bool   $can_be_shared
 * @property string $website_id
 */
class Blog extends UUIDModel
{
    public const PUBLIC = 'public';
    public const AUTHORIZED = 'authorized';

    protected $casts = [
        'published_at'=> 'datetime',
    ];

    protected $table = 'topics';
}
