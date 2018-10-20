    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

<title>
    @if (isset($title))
        {{ $title }}
    @elseif (isset($titlePrepend))
        {{ $currentSection . __(' · ') . $titlePrepend }}
    @endif
    {{ __(' | ') . config('app.name', 'Pateros Technological College') }}
</title>

<link rel="stylesheet" href="/css/app.css">