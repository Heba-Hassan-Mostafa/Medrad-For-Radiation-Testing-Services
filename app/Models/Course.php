<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, Sluggable,HasTranslations,LogsActivity;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','category_id','content','content_home','status','publish_date','keywords','description'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Courses ")
        ->dontSubmitEmptyLogs();
    }

    public $translatable = ['name','content','content_home'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class , 'imageable');
    }

    public function status()
    {
        return $this->status ? trans('dashboard.active') : trans('dashboard.in-active');
    }

    public function scopeActive($query)
    {
        return  $query->whereStatus(1);
    }

    public function scopeActiveCategory($query)
    {
        return  $query->whereHas('category', function($q){

             $q->whereStatus(1)->whereCategoryType(Category::TYPE[1]);
        });
    }

    public function scopePublish($query)
    {
        return  $query->where('publish_date','<=',Carbon::now()->toDateString());
    }
}