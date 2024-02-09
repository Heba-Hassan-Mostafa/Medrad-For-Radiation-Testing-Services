<?php

namespace App\Helpers;


class TypeMatcher
{
    protected string $type;


    public function __construct()
    {
        $this->type = request()->input('category_type')??'service';
    }

    public function __invoke(): string
    {
        return match ($this->type) {
            'services', 'service' => 'service',
            'courses', 'course' => 'course',
            'galleries', 'gallery' => 'gallery',
            default => '',
        };//end switch
    }
}