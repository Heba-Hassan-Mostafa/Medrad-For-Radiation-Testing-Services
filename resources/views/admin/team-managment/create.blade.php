<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">{{ trans('dashboard.add-new-member') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.team_managment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name" class="form-label">{{ trans('dashboard.member_name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="position" class="form-label">{{ trans('dashboard.position') }}</label>
                            <input type="text" name="position" value="{{ old('position') }}" class="form-control" />
                            @error('position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="gender" class="form-label">{{ trans('dashboard.gender') }}</label>
                            <select name="gender" class="form-control">
                                <option disabled selected value="">{{ trans('dashboard.select-gender') }}</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : null }}>
                                    {{ trans('dashboard.male') }}</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : null }}>
                                    {{ trans('dashboard.female') }}</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">{{ trans('dashboard.image') }}</label>
                            <input type="file" accept="image/*" name="image" class="form-control" />
                            @error('image')
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
