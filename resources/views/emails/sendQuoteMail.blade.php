<x-mail::message>
# Quote Request

# Quote Details


<ul>
    <li>First-Name: {{ $quote->first_name }}</li>
    <li>Last-Name: {{ $quote->last_name }}</li>
    <li>Email: {{ $quote->quote_email }}</li>
    <li>Phone: {{ $quote->phone }}</li>
    <li>Message: {{ $quote->message }}</li>

</ul>
<br>
{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
<span> {{ App\Models\Setting::where('key', 'website_name')->first()->value }} </span>
</x-mail::message>
