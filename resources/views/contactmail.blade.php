
@foreach ($data as $key => $value)
    <b>{{ $key }}:</b><br /> {!! nl2br(htmlspecialchars($value)) !!}  <br /><br />
@endforeach
