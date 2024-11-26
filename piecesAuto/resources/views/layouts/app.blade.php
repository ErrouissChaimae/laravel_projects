<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ajout de Font Awesome pour l'icône de l'œil -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 </head>
<body>
    @include('includes.navbar')
    <div  style="width: 100% ;background-color:rgba(231, 230, 230, 0.308);min-height:600px">
        @yield('content')
    </div>
    @include('includes.fot')

</body>
</html>
