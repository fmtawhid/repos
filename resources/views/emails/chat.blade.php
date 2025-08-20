@foreach ($messages as $message)
<span>[</span>{{ $message->created_at }}<span>]</span>

{{ $message->createdBy->name }}: {{$message->prompt}} <br>

{{ $message->chatExpert->expert_name }} : {!! $message->response !!}


@endforeach