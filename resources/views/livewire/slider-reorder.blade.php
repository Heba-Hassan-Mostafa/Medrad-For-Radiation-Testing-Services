<div class="table-responsive p-2" wire:ignore>
    <table class=" table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('dashboard.slider_title') }}</th>
                <th>{{ trans('dashboard.image') }}</th>

            </tr>
        </thead>
        <tbody wire:sortable="updateSliderOrder">
            @foreach ($sliders as $slider)
            <tr class="reOrder" wire:sortable.item="{{ $slider->id }}" wire:key="slider-{{ $slider->id }}"
                >
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>
                        @if(!empty($slider->image))
                        <img src="{{ asset('Files/Slider/'.$slider->image) }}" style="width:200px;height:100px;"></td>

                        @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
