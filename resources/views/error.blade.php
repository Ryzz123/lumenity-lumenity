<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Error' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            font-weight: 600;
            color: #FF2D20;
        }

        .message {
            font-size: 36px;
            font-weight: 400;
            color: #636b6f;
        }

        .separator {
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        }

        .ml-1 {
            margin-left: .25rem;
        }

        @media (prefers-color-scheme: dark) {
            html, body {
                background-color: #111827;
                color: #9ca3af;
            }

            .title {
                color: #FF2D20;
            }

            .message {
                color: #9ca3af;
            }
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            {{ $code ?? '500' }}<span class="separator">|</span><span class="message ml-1">{{ $message ?? 'Server Error' }}</span>
        </div>
    </div>
</div>
</body>
</html>