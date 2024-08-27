<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>{{ $title }}</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,700;1,400;1,700&display=swap");

        body {
            padding: 0;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
        }

        .content {
            font-family: "Inter", sans-serif;
            color: #bbb8b8;
            font-weight: normal;
            font-size: 16px;
            text-transform: uppercase;
            z-index: 10;
        }

        .content span {
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <p class="content">{{ $code }} <span>|</span> {{ $message }}</p>
</div>
</body>
</html>