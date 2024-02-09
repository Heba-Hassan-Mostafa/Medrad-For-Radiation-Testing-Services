<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded=[];
    protected $table = 'contact_us';
    public $timestamps = true;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['first_name'])
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} in the Contact Us")
        ->dontSubmitEmptyLogs();
    }

    public function getFullNameAttribute() :string
    {
        return ucfirst($this->contact_first_name) .' '. ucfirst( $this->contact_last_name);

    }
}
