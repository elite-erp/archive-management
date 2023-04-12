<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/icons/logo.png" />
    <title>إلايت أرشيف</title>

    @vite('resources/js/app.ts')
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>