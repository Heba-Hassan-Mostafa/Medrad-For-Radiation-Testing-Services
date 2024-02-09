@extends('admin.layouts.master')
@section('title')
    {{ trans('dashboard.activity-log') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.activity-log') }}
    </h4>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.name') }}</th>
                        <th>{{ trans('dashboard.time') }}</th>
                        <th>{{ trans('dashboard.description') }}</th>
                        <th>{{ trans('dashboard.changes') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($activities)
                                @foreach ($activities as $activity )
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $activity->causer->first_name }} {{ $activity->causer->last_name  }}</td>
                                    <td>{{ \Carbon\Carbon::parse($activity->created_at)->diffforhumans()  }}</td>

                                    <td>{{ $activity->description  }} {{ $activity->subject ? $activity->subject->name : ' '  }}</td>
                                    <?php
                                    $properties = $activity->properties->toArray();
                                    if(isset($properties['attributes'])){
                                    $subArr['attributes'] = $properties['attributes'];
                                    }
                                    if(isset($properties['old'])){
                                            $subArr['old'] = $properties['old'];
                                        }
                                     // var_dump( $subArr)

                                    ?>
                                    <td>

                                        @if(isset($subArr['old']))
                                        <div>{{ __('dashboard.before') }} :</div>
                                        @foreach ($subArr['old'] as $key => $value)
                                        <div>
                                            {{ __('dashboard.'.$key ) . " : ".  $value }}
                                        </div>

                                          @endforeach
                                          @endif
                                      <br>
                                      @if(isset($subArr['attributes']))
                                      <div>{{ __('dashboard.after') }} :</div>

                                      @foreach ($subArr['attributes'] as $key => $value)
                                      <div>
                                        {{ __('dashboard.'.$key ) . " : ".  $value }}
                                    </div>

                                        @endforeach
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

