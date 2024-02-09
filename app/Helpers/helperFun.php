<?php

namespace App\Helpers;

use App\Models\Setting;


 function setting()
{

    $setting = Setting::whereIn('key',[
        'logo',
        'website_name',
        'facebook',
        'instagram',
        'twitter',
        'description',
        'icon',
    ])->select('key','value')->get();

    return $setting;
}