<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            min-height: 100vh;
            margin: 0;
            /* background: linear-gradient(135deg, #4CAF50, #3D9970); */
            background: linear-gradient(135deg, #D3B88D, #D3B88D);
            color: #333;
        }

        .main {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            width: 400px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .main:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 28px;
            color: #D3B88D;
            /* color: #4CAF50; */
            margin-bottom: 10px;
        }

        h3 {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            color: #333;
            font-weight: bold;
        }

        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #D3B88D;
            /* border-color: #008B8B; */
            box-shadow: 0 0 5px #D3B88D;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #D3B88D;
            /* background: #45a049; */
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #008B8B;
            /* background: #008B8B; */
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="main">
        <h1>{{ $systemSetting?->system_name ?? 'Blinke' }}</h1>
        <h3>Enter Admin Login Credentials</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email:</label>
            <input type="email" value="{{ old('email') }}" placeholder="Your Email" name="email" id="email" />

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password:</label>
            <input type="password" placeholder="Password" id="password" name="password" />
            @error('password')
                <div class="error">Enter Your Valid Password</div>
            @enderror

            <button type="submit">Log In</button>
            {{-- <div class="text-end">
                <p class="mb-0"><a href="{{ route('password.request') }}" class="text-primary ms-1">Forgot
                        Password?</a></p>
            </div> --}}
        </form>
    </div>
</body>

</html>
