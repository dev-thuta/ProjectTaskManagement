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
        .welcome-box {
            background-color: transparent;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            max-width: 500px;
        }
        h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        .welcome-box p {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #ffffff;
            color: #6c63ff;
            border: none;
            font-weight: 500;
            padding: 10px 25px;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background-color: #eeeeee;
            color: #5e57f4;
        }
        .btn-outline-light {
            font-weight: 500;
            padding: 10px 25px;
            transition: all 0.3s ease-in-out;
        }
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-start align-items-center min-vh-100">
        <div class="col-lg-6 text-start mb-4 mb-lg-0 p-0">
            <img src="{{ asset('images/pexels-photo-3194519.jpeg') }}"
                    alt="Project Management"
                    class="img-fluid"   
                    style="max-width: 100%; height: 100vh;
                    opacity: 0.9;">
        </div>
        <div class="col-lg-6 welcome-box">
            <h1 class="mb-4">Project Task Management</h1>
            <p>A modern admin dashboard and task management system to keep everything organized and efficient.</p>
            <a href="{{ route('login') }}" class="btn btn-custom btn-lg me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light text-light btn-lg">Register</a>
        </div>
    </div>
</div>
</body>
</html>
