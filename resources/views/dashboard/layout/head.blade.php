<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" sizes="32x32" type="image/png" href="{{ asset('/img/delapan.png') }}">
<title>
    {{ auth()->user()->role }}
    @if (Route::currentRouteName())
        - {{ ucfirst(str_replace('-', ' ', Route::currentRouteName())) }}
    @else
        - Dashboard
    @endif
    - Studio Foto
</title>

<!-- Icons & Favicon -->
<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

<!-- Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded">
<link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS Files -->
<link id="pagestyle" href="{{ asset('css/material-dashboard.min.css?v=3.2.0') }}" rel="stylesheet">

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
