<?php namespace professionalweb\lms\Blog\Interfaces;

interface ApiMethods
{
    /**
     * Get blog list
     */
    public const API_METHOD_BLOG_LIST = '/blog';

    /**
     * Get blog by id
     */
    public const API_METHOD_GET_BLOG = '/blog/{id}';

    /**
     * Remote blog by id
     */
    public const API_METHOD_REMOVE_BLOG = '/blog/{id}';

    /**
     * Create blog
     */
    public const API_METHOD_STORE_BLOG = '/blog';

    /**
     * Update blog
     */
    public const API_METHOD_UPDATE_BLOG = '/blog/{id}';
}