 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content" style="z-index: 10;">
             <div class="modal-header">

                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('website.quote') }}" method="POST" class="demo-form1">
                     @csrf
                    
                     <div class="quoteInput quoteInputModal d-flex row justify-content-center">
                         <input class="col-md-10" type="text" name="first_name"
                             placeholder="{{ trans('frontend.first_name') }}" />
                         @error('first_name')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                         <input class="col-md-10" type="text" name="last_name"
                             placeholder="{{ trans('frontend.last_name') }}" />
                         @error('last_name')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                         <input class="col-md-10" type="email" name="quote_email"
                             placeholder="{{ trans('frontend.email') }}" />
                         @error('quote_email')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                         <input type="tel" name="phone[main]" class="col-md-10 tel phone_number"
                             placeholder="{{ trans('frontend.phone') }}">
                         @error('phone')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                         <textarea class="col-md-10" name="message" id="" cols="30" rows="10"
                             placeholder="{{ trans('frontend.message') }}"></textarea>
                         @error('message')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                     </div>
                      <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse1">
                     @error('g-recaptcha-response')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                     <button type="submit" class="sendQuote" id="modalQuote">{{ trans('frontend.get_quote') }}</button>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger"
                     data-bs-dismiss="modal">{{ trans('frontend.close') }}</button>
             </div>

         </div>
     </div>
 </div>
 <!-- end modal quote form -->
