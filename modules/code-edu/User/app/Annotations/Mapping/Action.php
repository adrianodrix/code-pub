<?php namespace CodeEdu\User\Annotations\Mapping;


/**
 * Class Action
 *
 * @Annotation
 * @Target("METHOD")
 * @package CodeEdu\User\Annotations\Mapping
 */
class Action
{
    public $name;
    public $description;
}