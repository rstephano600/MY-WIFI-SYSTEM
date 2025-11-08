<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentication') - TTCL ISP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background: linear-gradient(135deg, 
            #FFFF00 0%,   
            #FFFFFF 35%, 
            #0000FF 65%, 
            #000000 100%  
        );
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .auth-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    .auth-header {
        background: linear-gradient(135deg, 
            #FFFF00 0%,   
            #FFFFFF 35%, 
            #0000FF 65%, 
            #000000 100%  
        );
        color: white;
        padding: 2rem;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }
    .btn-primary {
        background: linear-gradient(135deg, 
            #FFFF00 0%,   
            #FFFFFF 35%, 
            #0000FF 65%, 
            #000000 100%  
        );
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #764ba2 0%, #FFFF00 100%);
    }
</style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
