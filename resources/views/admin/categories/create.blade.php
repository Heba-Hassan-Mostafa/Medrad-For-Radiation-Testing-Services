<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">{{ trans('dashboard.add-new-cat') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">{{ trans('dashboard.cat-name_ar') }}</label>
                        <input dir="rtl" type="text" name="name" value="{{ old('name') }}" class="form-control"/>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">{{ trans('dashboard.cat-name_en') }}</label>
                        <input type="text" name="name_en" value="{{ old('name') }}" class="form-control"/>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="category_type" class="form-label">{{ trans('dashboard.category_type') }}</label>
                        <select name="category_type" class="form-control">
                            <option selected disabled value="">{{ trans('dashboard.choose_cat') }}</option>
                            @foreach (\App\Models\Category::TYPE as $type)
                                <option value="{{ $type }}"
                                    {{ app()->call(new \App\Helpers\TypeMatcher()) == $type ? 'selected' : '' }}>
                                    {{ __('messages.' . $type) }}</option>
                            @endforeach
                        </select>
                        @error('category_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="status" class="form-label">{{ trans('dashboard.status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == '1' ? 'selected' : null }}>
                                {{ trans('dashboard.active') }}</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : null }}>
                                {{ trans('dashboard.in-active') }}</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ trans('dashboard.save') }} </button>
            </div>
            </form>
            </div>



        </div>
    </div>
</div>
