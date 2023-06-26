@component('mail::message')
<h1>Hello {{$name}}</h1>

<p>We hope this message finds you well. We are writing to inform you that a response has been posted for the support ticket you issued.</p>

<p>Here are the details of the response:</p>

<p>
    <strong>Response:</strong><br>
    {{$content}}
</p>

<p>
    Thank you for reaching out to us. If you have any further questions or need additional assistance, please don't hesitate to let us know.
</p>

<p>
Yours sincerely, <br/>
{{ config('app.name') }}
</p>
@endcomponent