<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function subscriber_chart()
    {
        $subscribers = Subscriber::select(DB::raw('COUNT(*) as count'))->pluck('count');


    $chart['labels'] = $subscribers->keys()->toArray();
    $chart['datasets']['name'] = trans('dashboard.subscribers');
    $chart['datasets']['values'] = $subscribers->values()->toArray();


    return response()->json($chart);


    }

    public function quote_chart()
    {
        $quotes = Quote::select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('count','month');


        foreach ($quotes->keys() as $month_number) {
            $labels[] = date('F', mktime(0, 0, 0, $month_number, 1));
        }
        $chart['labels'] = $labels;
        $chart['datasets'][0]['name'] = trans('dashboard.quotes');
        $chart['datasets'][0]['values'] = $quotes->values()->toArray();

        return response()->json($chart);

    }
}