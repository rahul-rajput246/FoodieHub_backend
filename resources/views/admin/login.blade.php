<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg, #ff7e00, #ff3d00);
        }

        /* Admin Login Form */

        .login_box{
            width:350px;
            background:#fff;
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
            text-align:center;
        }

        .login_box h2{
            margin-bottom:10px;
            color:#333;
        }

        .login_box p{
            font-size:14px;
            color:#777;
            margin-bottom:20px;
        }

        .input_box{
            margin-bottom:15px;
            text-align:left;
        }

        .input_box label{
            font-size:13px;
            color:#555;
        }

        .input_box input{
            width:100%;
            padding:10px;
            margin-top:5px;
            border-radius:8px;
            border:1px solid #ddd;
            outline:none;
            transition:0.3s;
        }

        .input_box input:focus{
            border-color:#ff7e00;
        }

        .login_btn{
            width:100%;
            padding:12px;
            background:#ff7e00;
            color:#fff;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-weight:600;
            transition:0.3s;
        }

        .login_btn:hover{
            background:#ff3d00;
        }

        .logo{
            font-size:22px;
            font-weight:600;
            color:#000;
            margin-bottom:10px;
        }
        .logo span{
            color:#ff7e00;
        }
    </style>
</head>
<body>

<div class="login_box">

    <div class="logo">Foodie<span>Hub</span> Admin</div>

    <h2>Welcome Back</h2>
    <p>Login to manage your restaurant</p>

    @if(session('error'))
        <p style="color:red; margin-bottom:15px;">{{ session('error') }}</p>
    @endif
    
    <form action="{{ url('/admin/login') }}" method="POST">
        @csrf

        <div class="input_box">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter email" required>
        </div>

        <div class="input_box">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="login_btn">Login</button>
    </form>

</div>

</body>
</html>