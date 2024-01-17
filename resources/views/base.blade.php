<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="/css/theme-color.css">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="icon" type="image/png" sizes="16x16" href="/img/logo.png">
    
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script> <!-- Pour les icônes -->

</head>

<body class="site">

    @include('navbar.navbar')



    <div class="site-content">
        @yield('content') <!-- The main content of each page goes here -->
    </div>

    <footer>
        <div class="content has-text-centered">
            <p>All rights reserved &copy; Pascal Vigneau Pierlovisi</p>
        </div>
    </footer>


    @yield('scripts') <!-- Scripts for each page go here -->




    <script src="/js/theme-color.js"></script>
    <script src="/js/navbar.js"></script>
</body>

</html>