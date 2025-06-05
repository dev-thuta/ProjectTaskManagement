<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Your Project Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #6a64e1, #a084cf);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-start align-items-center min-vh-100">
        <div class="col-lg-5 text-start mb-4 mb-lg-0 p-0">
            <img src="{{ asset('images/pexels-photo-3194519.jpeg') }}"
                    alt="Project Management"
                    class="img-fluid"   
                    style="max-width: 100%; height: 100vh;
                    opacity: 0.9;">
        </div>
        <div class="col-lg-7 welcome-box">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>
