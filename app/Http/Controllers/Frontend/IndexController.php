<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Quote;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\ContactUs;
use App\Models\Subscriber;
use App\Mail\SendQuoteMail;
use Illuminate\Http\Request;
use App\Mail\ReplyContactUsMail;
use App\Mail\SendContactUseMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Website\QuoteRequest;
use App\Http\Requests\Website\CommentRequest;
use App\Http\Requests\Website\ContactUsRequest;
use App\Http\Requests\Website\IndexQuoteRequest;
use App\Http\Requests\Website\SubscriberRequest;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }


    public function about_us()
    {
        $about = About::first();
        return view('frontend.pages.about-us',compact('about'));
    }
    //Add-Quote
   public function quote(QuoteRequest $request)
    {
        $request->validated();
        $input['first_name']                = $request->first_name;
        $input['last_name']                 = $request->last_name;
        $input['quote_email']               = $request->quote_email;
        $input['phone']                     = $_REQUEST['phone']['full'];
        $input['message']                   = $request->message;


        $quote = Quote::create($input);
       $email = Setting::where('key', 'website_mailService')->first()->value;

        Mail::to($email)->send(new SendQuoteMail($quote));

        $success=[
            'message'=>trans('messages.send'),
            'alert-type'=>'success'
        ];

        return redirect()->route('website.index')->with($success);
    }

     //Add-Quote
   public function quoteIndex(IndexQuoteRequest $request)
   {
       $request->validated();
       $input['first_name']                = $request->first_name_index;
       $input['last_name']                 = $request->last_name_index;
       $input['quote_email']               = $request->email_index;
       $input['phone']                     = $_REQUEST['phone']['full'];
       $input['message']                   = $request->message_index;


       $quote = Quote::create($input);
      $email = Setting::where('key', 'website_mailService')->first()->value;

       Mail::to($email)->send(new SendQuoteMail($quote));

       $success=[
           'message'=>trans('messages.send'),
           'alert-type'=>'success'
       ];

       return redirect()->route('website.index')->with($success);
   }

     //add-subscribers
   public  function addSubscribe(SubscriberRequest $request)
   {
      
       Subscriber::create($request->validated());

       $success=[
        'message'=>trans('messages.stored'),
        'alert-type'=>'success'
    ];

    return redirect()->back()->with($success);

   }

    //add-subscribers
    public  function addComment(CommentRequest $request)
    {
         $request->validated();
       $data['name']                              = $request->name;
       $data['comment_email']                     = $request->comment_email;
       $data['comment_message']                   = $request->comment_message;


        Comment::create($data);

        $success=[
         'message'=>trans('messages.send'),
         'alert-type'=>'success'
     ];

     return redirect()->back()->with($success);

    }

    public function contact_us()
    {
        return view('frontend.pages.contact-us');
    }

    public function add_contact_us(ContactUsRequest $request)
    {
        $request->validated();
       $data['contact_first_name']                = $request->contact_first_name;
       $data['contact_last_name']                 = $request->contact_last_name;
       $data['email']                             = $request->email;
       $data['contact_phone']                     = $request->contact_phone;
       $data['contact_message']                   = $request->contact_message;

        $contact =  ContactUs::create($data);

        $email = Setting::where('key', 'website_mailService')->first()->value;

        Mail::to($email)->send(new SendContactUseMail($contact));

        $success=[

            'message'=>trans('messages.send'),
            'alert-type'=>'success'
        ];

        return redirect()->route('website.index')->with($success);


    }

}