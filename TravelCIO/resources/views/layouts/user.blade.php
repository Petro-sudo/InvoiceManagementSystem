<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{url('image/ndpright.png')}}">
    <title>Invoice Management System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="font-sans antialiased">
    <div class="relative min-h-screen md:flex">
        <!--sidebar-->
        <aside class="z-10 bg-blue-800 text-blue-100 w-64">
            <!-- <aside style="z-index: 10; background-color: #B29700; color: white; width: 46;"> -->
            <!--logo-->
            <div>
                <div>
                    <a href=""><img src="image/dotleft.jpg" width="12%" height="10%"></a>
                    <a> <span>Invoice Management</span></a>

                </div>

                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="block w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>



            <!--Nav Links-->
            <nav>

            </nav>
        </aside>

        <!--Main contant-->
        <main>
            <nav></nav>
            <div>

            </div>
        </main>
    </div>

</body>

</html>