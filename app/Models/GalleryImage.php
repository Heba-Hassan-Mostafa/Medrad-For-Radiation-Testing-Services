<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryImage extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];
    protected $table = 'gallery_images';
    public $timestamps = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['title','category_id','status'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Gallery")
        ->dontSubmitEmptyLogs();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class , 'imageable');
    }

    public function status()
    {
        return $this->status ?   trans('dashboard.active') :  trans('dashboard.in-active') ;
    }

    //scope active for gallery

    public function scopeActive($query)
    {
        return  $query->whereStatus(1);
    }

    //scope active for gallerycategory
    public function scopeActiveCategory($query)
    {
        return  $query->whereHas('category', function($q){

             $q->whereStatus(1)->whereCategoryType(Category::TYPE[2]);
        });
    }
}