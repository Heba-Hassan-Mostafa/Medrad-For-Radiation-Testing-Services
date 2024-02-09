<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model implements Feedable
{
    use HasFactory, Sluggable,HasTranslations,LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['title','content','content_home','status','keywords','description','publish_date'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Blog")
        ->dontSubmitEmptyLogs();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => request()->title
            ]
        ];
    }

    public $translatable = ['title','content','content_home'];

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->slug,
            'title' => $this->getTranslation('title','en'),
            'summary' => !empty($this->getTranslation('content','en')) ? $this->getTranslation('content','en') : '',
            'updated' => $this->created_at,
            'link' => route('website.blog.blog_content',$this->slug),
            'authorName' => Setting::where('key','website_name')->first()->value,
        ]);
    }


    public static function getFeedItems()
    {
       return Blog::orderBy('publish_date','desc')->get();
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

    public function scopePublish($query)
    {
        return  $query->where('publish_date','<=',Carbon::now()->toDateString());
    }

}