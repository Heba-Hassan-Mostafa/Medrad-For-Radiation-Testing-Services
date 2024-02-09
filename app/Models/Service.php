<?php

namespace App\Models;

use App\Models\Image;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','category_id','status','content','content_home','show_in_home','publish_date','keywords','description'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Services ")
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
    public function scopeShowInHome($query)
    {
        return  $query->whereShowInHome(1);
    }

    public function scopeActiveCategory($query)
    {
        return  $query->whereHas('category', function($q){

             $q->whereStatus(1)->whereCategoryType(Category::TYPE[0]);
        });
    }
}
