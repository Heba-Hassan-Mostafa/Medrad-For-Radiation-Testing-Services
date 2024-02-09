<x-mail::message>
# Contact-US Request

# Contact-Us Details


<ul>
    <li>First-Name: {{ $contact->first_name }}</li>
    <li>Last-Name: {{ $contact->last_name }}</li>
    <li>Email: {{ $contact->email }}</li>
    <li>Phone: {{ $contact->phone }}</li>
    <li>Message: {{ $contact->message }}</li>

</ul>
<br>
{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
<span> {{ App\Models\Setting::where('key', 'website_name')->first()->value }} </span>
</x-mail::message>
