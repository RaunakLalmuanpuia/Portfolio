<x-mail::message>
# Hi, there

Someone contacted you with this message:

"{{ $message }}"

Maybe, you want to get in touch, using this shared email: {{ $email }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
