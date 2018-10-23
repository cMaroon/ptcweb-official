    <meta charset="utf-8">
    <meta name="description" content="Pateros Technological College Official Website">
    <meta name="keywords" content="PTC">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_token">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
