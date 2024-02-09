<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sluggable,HasTranslations,LogsActivity;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' =>'name_en'
            ]
        ];
    }
    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','status','category_type'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Category")
        ->dontSubmitEmptyLogs();
    }

    const TYPE = [
        'service',
        'course',
        'gallery'
    ];

    public function  services()
    {
        return $this->hasMany(Service::class);
    }

    public function  courses()
    {
        return $this->hasMany(Course::class);
    }

    public function galleries()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function status()
    {
        return $this->status ? trans('dashboard.active') : trans('dashboard.in-active');
    }

    public function scopeActive($query)
    {
        return  $query->whereStatus(1);
    }

    public function scopeServiceType($query)
    {
        return  $query->whereCategoryType(Category::TYPE[0]);
    }

    public function scopeCourseType($query)
    {
        return  $query->whereCategoryType(Category::TYPE[1]);
    }

    public function scopeGalleryType($query)
    {
        return  $query->whereCategoryType(Category::TYPE[2]);
    }
}
