<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body content-modal-comment mx-3">
                <form action="{{ route('website.comment') }}" method="POST" class="demo-form4">
                    @csrf
                     <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse4">
                     @error('g-recaptcha-response')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                    <div class="mb-4">
                        <div class="md-form d-flex align-items-center">
                            <i class="fas fa-user prefix grey-text"></i>
                            <input class="form-control validate" name="name" type="text"
                                placeholder="{{ trans('frontend.name') }}" />
                        </div>
                        @error('name')
                        <span class="text-danger fw-bold text-start">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="md-form  d-flex align-items-center">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input class="form-control validate" name="comment_email" type="email"
                                placeholder="{{ trans('frontend.email') }}" />
                        </div>
                        @error('comment_email')
                                <span class="text-danger fw-bold text-start">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="md-form d-flex align-items-center">
                        <i class="fas fa-edit"></i>
                        <textarea class="md-textarea form-control count-limit" name="comment_message" type="text" rows="4"
                            placeholder="{{ trans('frontend.write-comment') }}" maxlength="200"></textarea>
                    </div>
                    @error('comment_message')
                            <span class="text-danger fw-bold text-start">{{ $message }}</span>
                    @enderror

                    <div class="alram-lim-text">
                        <p class="error-msg">Character Limit Exceed</p>
                        <p class="num-lim">
                            <span class="counting">0</span>
                            /200
                        </p>
                        <br clear="both" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="sendComment" id="indexComment">
                    {{ trans('frontend.submit') }}
                </button>
            </div>
            </form>


        </div>
    </div>
</div>
