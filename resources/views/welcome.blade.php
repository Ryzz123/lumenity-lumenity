<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="/public/favicon.ico">
    <title>Lumenity</title>
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
            flex-direction: column;
            text-align: center;
            position: relative; /* Added */
        }

        .content {
            font-family: "Inter", sans-serif;
            color: white;
            font-weight: 600;
            letter-spacing: 40px;
            font-size: 45px;
            text-shadow: 2px 2px 10px rgba(255, 255, 255, 0.607);
            z-index: 3;
            margin-left: 30px;
            text-transform: uppercase;
        }

        .background {
            content: " ";
            z-index: 2;
            border-radius: 94% 31% 30% 67% / 67% 37% 56% 34%;
            width: 120px;
            height: 120px;
            background: blue;
            position: absolute;
            filter: blur(50px);
            box-shadow: 5vmin 3vmin 0 #f09;
            opacity: 50%;
        }

        .subtitle {
            font-family: "Inter", sans-serif;
            text-align: center;
            color: #cecbcb;
            margin-top: -8px;
            display: grid;
            gap: -20px;
            font-size: 16px;
        }
        .subtitle2 {
            font-family: "Inter", sans-serif;
            font-size: 14px;
            text-align: center;
            color: #cecbcb;
            margin-top: -8px;
            display: grid;
            gap: -20px;
        }

        a {
            text-decoration: none;
            cursor: pointer;
            color: white; /* Added */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="content">Lumenity</h1>
    <p class="subtitle">{{ $title }}</p>
    <p class="subtitle2">
        {{ $content }}
    </p>
    <div class="background"></div>
</div>
</body>
</html>