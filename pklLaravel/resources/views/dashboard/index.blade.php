<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>halo {{ explode(' ', Auth::guard('web')->user()->name)[0] }}</h1>
    <h5>kamu {{ explode(' ', Auth::guard('web')->user()->role)[0] }}</h5>
</body>
</html>