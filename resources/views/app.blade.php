<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lumenity - A stunningly micro-framework for building lightning-fast APIs and blazing fast web applications">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <title>Lumenity - Lightning Fast Micro-Framework</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    <!-- External Tailwind CSS for better performance -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom styles for Lumenity branding */
        .lumenity-gradient {
            background: linear-gradient(135deg, #FF2D20 0%, #FF6B35 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0px 20px 40px 0px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-black text-black/50 dark:text-white/50">
<div class="min-h-screen">
    <!-- Background Image -->
    <img
            id="background"
            class="absolute hidden lg:block -left-60 top-0 max-w-[877px] w-full h-full object-cover z-0 opacity-10"
            src="https://laravel.com/assets/img/welcome/background.svg"
            alt="Background decoration"
            loading="lazy"
    />

    <!-- Main Content -->
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

            <!-- Header -->
            <header class="text-center mb-12">
                <h1 class="text-4xl lg:text-6xl font-bold lumenity-gradient bg-clip-text text-transparent mb-4">
                    Lumenity
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 dark:text-gray-300">
                    Lightning-fast micro-framework for modern web development
                </p>
            </header>

            <!-- Main Grid -->
            <main class="mt-6">
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">

                    <!-- Lumenity Framework Card -->
                    <article class="card-hover flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg ring-1 ring-white/[0.05] focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16" aria-hidden="true">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="#FF2D20">
                                    <path d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z"/>
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3 sm:pt-5 flex-1">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Lumenity Framework</h2>
                            <p class="mt-4 text-sm/relaxed text-gray-600 dark:text-gray-300">
                                Lumenity is a stunningly micro-framework designed for building lightning-fast APIs and blazing fast web applications. Perfect for Laravel-based micro-services and high-performance APIs.
                            </p>
                        </div>

                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20] opacity-60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                        </svg>
                    </article>

                    <!-- Lumenity News Card -->
                    <article class="card-hover flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg ring-1 ring-white/[0.05] focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16" aria-hidden="true">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="#FF2D20">
                                    <path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/>
                                    <path d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z"/>
                                    <path d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z"/>
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3 sm:pt-5 flex-1">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Lumenity News</h2>
                            <p class="mt-4 text-sm/relaxed text-gray-600 dark:text-gray-300">
                                Stay updated with the latest Lumenity ecosystem news. A community-driven portal aggregating package releases, tutorials, and important announcements.
                            </p>
                        </div>

                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20] opacity-60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                        </svg>
                    </article>

                    <!-- Lumenity Ecosystem Card -->
                    <article class="card-hover flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg ring-1 ring-white/[0.05] focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16" aria-hidden="true">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="#FF2D20">
                                    <path d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z"/>
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3 sm:pt-5 flex-1">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Lumenity Ecosystem</h2>
                            <p class="mt-4 text-sm/relaxed text-gray-600 dark:text-gray-300">
                                Discover a vibrant community of developers building and sharing open-source packages that extend the framework with new functionality.
                            </p>
                        </div>
                    </article>

                    <!-- Lumenity Packages Card -->
                    <article class="card-hover flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg ring-1 ring-white/[0.05] focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16" aria-hidden="true">
                            <svg class="size-5 sm:size-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <g fill="#FF2D20">
                                    <path d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"/>
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3 sm:pt-5 flex-1">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Lumenity Packages</h2>
                            <p class="mt-4 text-sm/relaxed text-gray-600 dark:text-gray-300">
                                Explore community-built packages that extend Lumenity's functionality. Find solutions for common problems or contribute your own packages.
                            </p>
                        </div>
                    </article>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-16 text-center text-xs lg:text-sm text-gray-500 dark:text-white/70">
                <p>
                    Lumenity v6.1.0
                    <span class="mx-2">•</span>
                    PHP v{{ PHP_VERSION }}
                    <span class="mx-2">•</span>
                    <span class="text-[#FF2D20]">Built with ❤️ for developers</span>
                </p>
            </footer>
        </div>
    </div>
</div>
</body>
</html>