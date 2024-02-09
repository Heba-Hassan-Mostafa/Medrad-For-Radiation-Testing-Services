<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamManagment extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];
    protected $table = 'team_managments';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','position','gender','status'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Team Managment")
        ->dontSubmitEmptyLogs();
    }

    public function image()
    {
        return $this->morphOne(Image::class , 'imageable');
    }

    public function scopeActive($query)
    {
        return  $query->whereStatus(1);
    }
}
