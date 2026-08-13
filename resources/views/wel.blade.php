<!DOCTYPE html>

<html class="light" lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>Warisan Nusantara - Modern Heritage</title>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Playfair+Display:wght@500;600;700&amp;display=swap"
            rel="stylesheet" />
        <!-- Material Symbols -->
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
            rel="stylesheet" />
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
            rel="stylesheet" />
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <!-- Tailwind Config -->
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "surface-bright": "#fff8f6",
                            "error": "#ba1a1a",
                            "on-primary-container": "#ffb8a6",
                            "on-secondary": "#ffffff",
                            "secondary-container": "#fed65b",
                            "on-error": "#ffffff",
                            "on-tertiary-fixed-variant": "#384c34",
                            "surface-container-low": "#fff1ed",
                            "outline-variant": "#dcc1ba",
                            "error-container": "#ffdad6",
                            "inverse-surface": "#392e2b",
                            "surface": "#fff8f6",
                            "tertiary": "#2f422b",
                            "surface-tint": "#9b442d",
                            "on-tertiary-container": "#b8cfb0",
                            "primary-fixed": "#ffdbd2",
                            "on-surface": "#231917",
                            "surface-container-lowest": "#ffffff",
                            "on-tertiary": "#ffffff",
                            "secondary": "#735c00",
                            "on-primary": "#ffffff",
                            "surface-dim": "#e8d6d2",
                            "secondary-fixed-dim": "#e9c349",
                            "on-secondary-fixed-variant": "#574500",
                            "tertiary-fixed": "#d2e9c9",
                            "on-surface-variant": "#55423e",
                            "background": "#fff8f6",
                            "on-secondary-container": "#745c00",
                            "primary-fixed-dim": "#ffb4a1",
                            "tertiary-fixed-dim": "#b6cdae",
                            "surface-variant": "#f1dfda",
                            "surface-container": "#fceae6",
                            "on-background": "#231917",
                            "on-secondary-fixed": "#241a00",
                            "primary": "#6f2410",
                            "inverse-on-surface": "#ffede9",
                            "on-tertiary-fixed": "#0e200c",
                            "on-primary-fixed": "#3c0800",
                            "inverse-primary": "#ffb4a1",
                            "on-primary-fixed-variant": "#7c2d18",
                            "surface-container-high": "#f7e4e0",
                            "surface-container-highest": "#f1dfda",
                            "secondary-fixed": "#ffe088",
                            "primary-container": "#8e3a24",
                            "on-error-container": "#93000a",
                            "tertiary-container": "#455941",
                            "outline": "#89726d"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.125rem",
                            "lg": "0.25rem",
                            "xl": "0.5rem",
                            "full": "0.75rem"
                        },
                        "spacing": {
                            "container-max": "1280px",
                            "gutter": "24px",
                            "margin-desktop": "64px",
                            "section-gap": "120px",
                            "unit": "8px",
                            "margin-mobile": "20px"
                        },
                        "fontFamily": {
                            "headline-md": [
                                "Playfair Display"
                            ],
                            "display-lg-mobile": [
                                "Playfair Display"
                            ],
                            "body-lg": [
                                "Inter"
                            ],
                            "body-md": [
                                "Inter"
                            ],
                            "headline-lg-mobile": [
                                "Playfair Display"
                            ],
                            "label-sm": [
                                "Inter"
                            ],
                            "display-lg": [
                                "Playfair Display"
                            ],
                            "headline-lg": [
                                "Playfair Display"
                            ],
                            "label-lg": [
                                "Inter"
                            ],
                            "headline-sm": [
                                "Playfair Display"
                            ]
                        },
                        "fontSize": {
                            "headline-md": [
                                "32px",
                                {
                                    "lineHeight": "40px",
                                    "fontWeight": "600"
                                }
                            ],
                            "display-lg-mobile": [
                                "40px",
                                {
                                    "lineHeight": "48px",
                                    "letterSpacing": "-0.01em",
                                    "fontWeight": "700"
                                }
                            ],
                            "body-lg": [
                                "18px",
                                {
                                    "lineHeight": "28px",
                                    "fontWeight": "400"
                                }
                            ],
                            "body-md": [
                                "16px",
                                {
                                    "lineHeight": "24px",
                                    "fontWeight": "400"
                                }
                            ],
                            "headline-lg-mobile": [
                                "32px",
                                {
                                    "lineHeight": "40px",
                                    "fontWeight": "600"
                                }
                            ],
                            "label-sm": [
                                "12px",
                                {
                                    "lineHeight": "16px",
                                    "letterSpacing": "0.03em",
                                    "fontWeight": "500"
                                }
                            ],
                            "display-lg": [
                                "64px",
                                {
                                    "lineHeight": "72px",
                                    "letterSpacing": "-0.02em",
                                    "fontWeight": "700"
                                }
                            ],
                            "headline-lg": [
                                "48px",
                                {
                                    "lineHeight": "56px",
                                    "fontWeight": "600"
                                }
                            ],
                            "label-lg": [
                                "14px",
                                {
                                    "lineHeight": "20px",
                                    "letterSpacing": "0.05em",
                                    "fontWeight": "600"
                                }
                            ],
                            "headline-sm": [
                                "24px",
                                {
                                    "lineHeight": "32px",
                                    "fontWeight": "500"
                                }
                            ]
                        }
                    },
                },
            }
        </script>
    </head>

    <body
        class="bg-surface text-on-surface font-body-md text-body-md antialiased selection:bg-tertiary-container selection:text-on-tertiary-container">
        <!-- TopNavBar -->
        <header
            class="bg-surface/90 backdrop-blur-md sticky top-0 w-full z-50 border-b border-outline-variant/30 flat no shadows">
            <div class="flex justify-between items-center h-20 px-margin-desktop max-w-container-max mx-auto">
                <!-- Brand -->
                <div class="font-headline-md text-headline-md font-bold text-primary tracking-tight">Warisan Nusantara
                </div>
                <!-- Navigation Links -->
                <nav class="hidden md:flex gap-8 items-center h-full">
                    <a class="font-headline-sm text-headline-sm text-primary border-b-2 border-primary pb-1 hover:text-tertiary hover:border-tertiary transition-all duration-300 transform hover:scale-95 duration-150"
                        href="#">Home</a>
                    <a class="font-headline-sm text-headline-sm text-on-surface-variant hover:text-tertiary transition-colors transition-all duration-300"
                        href="#">Gallery</a>
                    <a class="font-headline-sm text-headline-sm text-on-surface-variant hover:text-tertiary transition-colors transition-all duration-300"
                        href="#">Festival Calendar</a>
                    <a class="font-headline-sm text-headline-sm text-on-surface-variant hover:text-tertiary transition-colors transition-all duration-300"
                        href="#">Profile</a>
                </nav>
                <!-- Trailing Actions -->
                <div class="flex items-center gap-6">
                    <div class="flex gap-4 items-center">
                        <span
                            class="material-symbols-outlined text-on-surface-variant hover:text-tertiary cursor-pointer transition-colors"
                            data-icon="notifications">notifications</span>
                        <span
                            class="material-symbols-outlined text-on-surface-variant hover:text-tertiary cursor-pointer transition-colors"
                            data-icon="search">search</span>
                    </div>
                    <button
                        class="bg-primary text-on-primary rounded font-label-lg text-label-lg px-6 py-2.5 hover:bg-tertiary hover:text-on-tertiary transition-colors shadow-sm">Explore</button>
                </div>
            </div>
        </header>
        <main class="max-w-container-max mx-auto px-margin-desktop">
            <!-- Hero Section: Daily Discovery -->
            <section class="py-section-gap grid grid-cols-12 gap-gutter items-center relative">
                <!-- Subtle Level -1 Batik Pattern Background Placeholder -->
                <div class="absolute inset-0 opacity-5 pointer-events-none"
                    style="background-image: radial-gradient(#6f2410 1px, transparent 1px); background-size: 32px 32px;">
                </div>
                <!-- Left: Artifact Frame -->
                <div class="col-span-7 relative z-10 pr-gutter">
                    <div
                        class="p-4 bg-surface-container-lowest border border-outline-variant shadow-[0_30px_60px_-15px_rgba(111,36,16,0.05)] relative rounded-sm">
                        <!-- Inner Gold Frame -->
                        <div class="absolute inset-4 border border-secondary-fixed-dim/40 pointer-events-none z-20">
                        </div>
                        <div class="relative overflow-hidden w-full aspect-[4/3]">
                            <img class="w-full h-full object-cover filter sepia-[.08] contrast-105 relative z-10 transition-transform duration-[2000ms] hover:scale-105"
                                data-alt="A highly detailed, high-resolution museum-quality photograph of an intricately carved Indonesian Wayang Kulit shadow puppet. The puppet is made of dark buffalo hide with precise, delicate perforations, depicting a mythological figure. It is presented against a pure, bright off-white minimalist gallery background, bathed in soft, warm directional light that casts a subtle, elegant shadow to emphasize its flat, two-dimensional nature. The overall aesthetic is curatorial, timeless, and perfectly aligned with a light-mode Modern Heritage design system."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkePIH-M8Z3uW0ljksQM42G2IQF06jAq1HiHT1HLbOH7uivJkhrzNQgdiJhHvIzStAvc3fIBP5iMFki-8tN5lvWh28MqnkVnJ3PHh3OyAXmwuWIGLIpmxSBKASXSs-seFFXXHIKo0hEKpECXOq4vCMgBjyn-2w49RMIPpMWcjapVLysByiUdjo9XZMwPfeFe6jDePAvOhkCgdyMffw_rNIuTc44EAZCW1oRpAo4CPzBwjc7W3Ye5VVew" />
                        </div>
                    </div>
                </div>
                <!-- Right: Content -->
                <div class="col-span-5 pl-4 z-10">
                    <span class="text-tertiary font-label-lg text-label-lg tracking-[0.2em] uppercase mb-6 block">Daily
                        Discovery</span>
                    <h1 class="font-display-lg text-display-lg text-primary mb-6">Wayang Kulit</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 leading-relaxed">
                        Discover the intricate art of Indonesian shadow puppetry. A timeless storytelling tradition
                        bridging the physical and spiritual realms, masterfully carved from buffalo hide and brought to
                        life by the Dalang beneath the warm glow of an oil lamp.
                    </p>
                    <div class="flex gap-4">
                        <button
                            class="bg-primary text-on-primary rounded-lg font-label-lg text-label-lg px-8 py-4 hover:bg-tertiary hover:text-on-tertiary transition-colors shadow-sm">View
                            Collection</button>
                        <button
                            class="border border-tertiary text-tertiary rounded-lg font-label-lg text-label-lg px-8 py-4 hover:bg-tertiary hover:text-on-tertiary transition-colors">Read
                            History</button>
                    </div>
                </div>
            </section>
            <!-- Upcoming Festivals Section -->
            <section class="pb-section-gap pt-12 relative z-10">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="font-headline-lg text-headline-lg text-primary">Upcoming Festivals</h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mt-3 max-w-2xl">Experience the
                            living, breathing traditions that pulse through the archipelago, preserved through communal
                            celebration.</p>
                    </div>
                    <a class="text-tertiary font-label-lg text-label-lg hover:text-tertiary-container transition-colors flex items-center gap-2 pb-1 border-b border-transparent hover:border-tertiary"
                        href="#">
                        View Complete Calendar <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-gutter">
                    <!-- Festival Card 1 -->
                    <div
                        class="bg-surface-container-lowest border border-outline-variant/50 group hover:shadow-[0_20px_40px_-10px_rgba(111,36,16,0.08)] hover:-translate-y-1 transition-all duration-500 rounded-lg overflow-hidden flex flex-col">
                        <div class="relative overflow-hidden aspect-[3/2]">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 ease-out filter sepia-[.05]"
                                data-alt="A captivating, bright photograph capturing the vibrant energy of a traditional Indonesian festival during the day. The scene shows dancers in ornate, colorful traditional garments moving gracefully in an open-air courtyard. The lighting is natural, high-key, and soft, enhancing the rich terracotta and ochre tones of their attire against a serene, light architectural background. The image feels curatorial, joyful, and deeply connected to cultural heritage."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxZlO8tAJwSWSzu5MeUL9JR9vVycZCFsF9OFMqIdLRYXl_vvAoAX-2tW1OLt9Oa2ayxFXqsSyQKZc8HMcO2iD13TdTcEeUluuQ6_HDASnIBdSr60YumH-DZE6Nu8BVnI8vJQmvROjG7iWamvq7686rvdOfAqSnnoe_fep8lb2bzRYFL4QNyqWSKKv1FYu8S5SLPasPKhkKian9-PTCOmrE4QUd6UulNoJvNsLGC_5kM3XyU7igH1eeuA" />
                            <div
                                class="absolute top-4 left-4 bg-tertiary text-on-tertiary font-label-sm text-label-sm px-3 py-1.5 rounded-full backdrop-blur-sm bg-opacity-90 shadow-sm">
                                Central Java</div>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="font-label-sm text-label-sm text-tertiary mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">calendar_month</span> October 12 -
                                15, 2024
                            </div>
                            <h3 class="font-headline-md text-headline-md text-primary mb-3">Sekaten Grand Festival</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-6 line-clamp-2 flex-1">A
                                week-long royal festival celebrating history and spirituality in the heart of Surakarta,
                                featuring gamelan recitals and vibrant night markets.</p>
                            <button
                                class="w-full border border-outline text-on-surface font-label-lg text-label-lg py-3 rounded group-hover:border-tertiary group-hover:text-tertiary transition-colors">Event
                                Details</button>
                        </div>
                    </div>
                    <!-- Festival Card 2 -->
                    <div
                        class="bg-surface-container-lowest border border-outline-variant/50 group hover:shadow-[0_20px_40px_-10px_rgba(111,36,16,0.08)] hover:-translate-y-1 transition-all duration-500 rounded-lg overflow-hidden flex flex-col">
                        <div class="relative overflow-hidden aspect-[3/2]">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 ease-out filter sepia-[.05]"
                                data-alt="An expansive, beautifully composed wide shot of a traditional Balinese temple procession under a clear, bright sky. Devotees in pristine white and pale gold ceremonial dress carry towering, intricately woven offerings of fruits and flowers. The aesthetic is clean, minimalist, and deeply respectful, utilizing a high-key lighting style that emphasizes the bright white surface tones and warm, organic accents of the Modern Heritage design system."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAL1IsVfI1inQRUqrvvX_62Y7MxbDvI7cTsxCprcLg-C5STx6Qg76fhyZIBiju2YqhqP0dsN1ZAz8TMOo8fBgv0p4nwY9Bwips09Tej_PXosvl6Tel_6z_vxw6e0zmHZb1DMfsdyUKNkdt11Iu62LW4aED87Sr-gKBoTwUUaE3hOh7e00nI1gWBcG1lCDpm_AR0V8silesRxDJfevIsjTOA_k-0JZR4LAAIwLBthSEbdSGmRQf6kAQ47Q" />
                            <div
                                class="absolute top-4 left-4 bg-tertiary text-on-tertiary font-label-sm text-label-sm px-3 py-1.5 rounded-full backdrop-blur-sm bg-opacity-90 shadow-sm">
                                Bali</div>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="font-label-sm text-label-sm text-tertiary mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">calendar_month</span> November 4,
                                2024
                            </div>
                            <h3 class="font-headline-md text-headline-md text-primary mb-3">Galungan Ceremonies</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-6 line-clamp-2 flex-1">
                                Witness the island adorned with elegant penjor poles, marking the triumph of Dharma over
                                Adharma in this visually stunning island-wide observance.</p>
                            <button
                                class="w-full border border-outline text-on-surface font-label-lg text-label-lg py-3 rounded group-hover:border-tertiary group-hover:text-tertiary transition-colors">Event
                                Details</button>
                        </div>
                    </div>
                    <!-- Festival Card 3 -->
                    <div
                        class="bg-surface-container-lowest border border-outline-variant/50 group hover:shadow-[0_20px_40px_-10px_rgba(111,36,16,0.08)] hover:-translate-y-1 transition-all duration-500 rounded-lg overflow-hidden flex flex-col">
                        <div class="relative overflow-hidden aspect-[3/2]">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 ease-out filter sepia-[.05]"
                                data-alt="A striking, cinematic photograph of traditional Indonesian boat racing, focusing on a beautifully carved, long wooden vessel cutting through calm, sunlit waters. The image captures a moment of synchronized effort by rowers in traditional minimalist attire. The scene is bathed in bright, warm sunlight, creating a high-contrast yet soft aesthetic that perfectly aligns with a curatorial, light-mode museum presentation style, highlighting the rich wood tones against bright surroundings."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKuzYQgAPSHjOid3UTAXPhMLEGmup_QQcFqYkwR7J-TXjpeqcrL-j_hQLN742dxr-3GT06fDLclZmrKPQY8f4w8Eg0P0E6a0IyZ5ABjZa3_JWD0uwsS-WMNkRfxvCJphQ2DLwEpgiILIJ3V9YJaWKnug8VeQiS9SxDaWfIl36Vo3AsGF_t1UDKZWLO5lC7EmwQL0DmCWwxnoTpfQDFjnYL1lTgWlkUlsMigzDnkH68XuvcvnpjDrh2ow" />
                            <div
                                class="absolute top-4 left-4 bg-tertiary text-on-tertiary font-label-sm text-label-sm px-3 py-1.5 rounded-full backdrop-blur-sm bg-opacity-90 shadow-sm">
                                Riau Islands</div>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="font-label-sm text-label-sm text-tertiary mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">calendar_month</span> December 10 -
                                12, 2024
                            </div>
                            <h3 class="font-headline-md text-headline-md text-primary mb-3">Pacu Jalur Regatta</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-6 line-clamp-2 flex-1">A
                                thrilling display of maritime heritage where beautifully decorated longboats race down
                                the Kuantan River, cheered by thousands.</p>
                            <button
                                class="w-full border border-outline text-on-surface font-label-lg text-label-lg py-3 rounded group-hover:border-tertiary group-hover:text-tertiary transition-colors">Event
                                Details</button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Heritage Stories Section (Bento Grid Style) -->
            <section class="pb-section-gap relative z-10">
                <!-- Editorial Divider -->
                <div class="mb-16">
                    <h2 class="font-headline-lg text-headline-lg text-primary text-center">Heritage Stories</h2>
                    <div class="flex items-center justify-center gap-6 mt-8">
                        <div class="h-[1px] bg-outline-variant w-24"></div>
                        <div class="w-2.5 h-2.5 rotate-45 border border-tertiary bg-surface-bright"></div>
                        <div class="h-[1px] bg-outline-variant w-24"></div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-gutter h-[600px]">
                    <!-- Large Feature Story (Span 8 cols) -->
                    <a class="col-span-8 group relative overflow-hidden rounded-xl bg-surface-container-lowest block h-full"
                        href="#">
                        <img class="w-full h-full object-cover absolute inset-0 group-hover:scale-105 transition-transform duration-[1500ms] ease-out filter sepia-[.08]"
                            data-alt="A masterful, high-resolution close-up photograph of an indigenous Indonesian weaver working on a traditional Sumba Ikat textile. The focus is on her aged, experienced hands and the intricate, deeply colored threads on the wooden loom. The lighting is soft, natural, and directional, highlighting the rich textures and the terracotta, indigo, and off-white color palette. The image feels deeply authentic, timeless, and curatorial, embodying a minimalist Modern Heritage aesthetic."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKtaAJ-al7hMLhe8zLdmYvoN87tf-aehhxumY25Fb-5kZvdwYOfSiUJFlOPMPmAfhukiTA4Uii3EPz_UoEnHTCCDFdRMrVz9A8vnD5v6Z8U7WCVA9BXdTT8PGrybTTmezPE_hUntH178dgIgUox4ZHCOnr46vk0hBib_9CJ6JyaAfozitZBjoZHqjiVsRrbINNkQRWd686M31k6xXYbwFIqDILKuaMkpFMDr1q7jgrC590VeKte5i2KA" />
                        <!-- Gradient overlay for text readability -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-inverse-surface/90 via-inverse-surface/30 to-transparent">
                        </div>
                        <div class="absolute bottom-0 left-0 p-12 text-on-tertiary w-full">
                            <div
                                class="bg-primary/90 backdrop-blur-md inline-block text-on-primary font-label-sm text-label-sm px-4 py-1.5 rounded-full mb-6 tracking-wide uppercase">
                                Textile Arts</div>
                            <h3
                                class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg mb-4 text-white leading-tight">
                                The Sacred Threads of Sumba</h3>
                            <p class="font-body-lg text-body-lg text-surface-variant max-w-2xl line-clamp-2 mb-6">
                                Exploring the intricate process of creating Ikat textiles in eastern Indonesia, where
                                every motif serves as a historical record, telling profound stories of ancestry,
                                animism, and cosmic balance.
                            </p>
                            <span
                                class="inline-flex items-center gap-2 text-surface-container font-label-lg text-label-lg group-hover:text-tertiary transition-colors">
                                Read Feature <span class="material-symbols-outlined">arrow_outward</span>
                            </span>
                        </div>
                    </a>
                    <!-- Side Smaller Stories (Span 4 cols) -->
                    <div class="col-span-4 flex flex-col gap-gutter h-full">
                        <!-- Small Story 1 -->
                        <a class="flex-1 bg-surface-bright p-8 flex flex-col justify-between group rounded-xl border border-outline-variant/40 hover:shadow-[0_15px_35px_rgba(111,36,16,0.06)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden"
                            href="#">
                            <div
                                class="absolute right-0 top-0 w-32 h-32 bg-surface-container-high rounded-bl-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform">
                            </div>
                            <div class="relative z-10">
                                <span
                                    class="text-tertiary font-label-sm text-label-sm tracking-widest uppercase mb-4 block">Architecture</span>
                                <h4
                                    class="font-headline-md text-headline-md text-primary mb-3 group-hover:text-tertiary transition-colors leading-snug">
                                    The Geometry of Rumah Gadang</h4>
                                <p class="font-body-md text-body-md text-on-surface-variant line-clamp-3">
                                    The distinct horn-like swooping roofs of Minangkabau traditional homes represent
                                    both elevated social status and a deep-rooted, centuries-old matrilineal heritage.
                                </p>
                            </div>
                            <div
                                class="mt-6 flex items-center justify-between text-outline font-label-sm text-label-sm relative z-10">
                                <span class="flex items-center gap-1.5"><span
                                        class="material-symbols-outlined text-[16px]">schedule</span> 5 min read</span>
                                <div
                                    class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </div>
                            </div>
                        </a>
                        <!-- Small Story 2 -->
                        <a class="flex-1 bg-surface-bright p-8 flex flex-col justify-between group rounded-xl border border-outline-variant/40 hover:shadow-[0_15px_35px_rgba(111,36,16,0.06)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden"
                            href="#">
                            <div
                                class="absolute right-0 bottom-0 w-40 h-40 bg-surface-container-high rounded-tl-full -mr-20 -mb-20 opacity-50 group-hover:scale-110 transition-transform">
                            </div>
                            <div class="relative z-10">
                                <span
                                    class="text-tertiary font-label-sm text-label-sm tracking-widest uppercase mb-4 block">Culinary
                                    Heritage</span>
                                <h4
                                    class="font-headline-md text-headline-md text-primary mb-3 group-hover:text-tertiary transition-colors leading-snug">
                                    The Slow Art of Authentic Rendang</h4>
                                <p class="font-body-md text-body-md text-on-surface-variant line-clamp-3">
                                    More than merely a dish, traditional slow-cooked Rendang embodies a profound
                                    philosophy of patience, community collaboration, and indigenous preservation
                                    techniques in West Sumatra.
                                </p>
                            </div>
                            <div
                                class="mt-6 flex items-center justify-between text-outline font-label-sm text-label-sm relative z-10">
                                <span class="flex items-center gap-1.5"><span
                                        class="material-symbols-outlined text-[16px]">schedule</span> 8 min read</span>
                                <div
                                    class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer -->
        <footer
            class="w-full mt-section-gap bg-surface-container-highest relative overflow-hidden flat no shadows border-t border-outline-variant/20">
            <!-- Subtle Background Motif -->
            <div
                class="absolute right-0 bottom-0 opacity-[0.03] pointer-events-none transform translate-x-1/4 translate-y-1/4">
                <svg class="text-primary" fill="currentColor" height="400" viewbox="0 0 100 100" width="400">
                    <path d="M50 0 L100 50 L50 100 L0 50 Z"></path>
                </svg>
            </div>
            <div
                class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-desktop py-16 max-w-container-max mx-auto relative z-10">
                <!-- Brand Column -->
                <div class="col-span-1 md:col-span-1 flex flex-col justify-between h-full">
                    <div>
                        <h4 class="font-headline-sm text-headline-sm text-primary mb-2">Warisan Nusantara</h4>
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-xs mt-4">Curating and
                            preserving the delicate threads of Indonesian history for the digital age.</p>
                    </div>
                    <p class="font-label-sm text-label-sm text-outline mt-12">© 2024 Warisan Nusantara. Preserving the
                        threads of time.</p>
                </div>
                <!-- Links Column -->
                <div
                    class="col-span-1 md:col-span-3 flex flex-wrap gap-x-12 gap-y-6 md:justify-end items-start mt-8 md:mt-0 font-body-md text-body-md text-on-surface-variant">
                    <a class="text-on-surface-variant hover:text-tertiary transition-colors hover:opacity-80 focus:ring-1 focus:ring-tertiary-container rounded px-2 py-1 -ml-2"
                        href="#">Archives</a>
                    <a class="text-on-surface-variant hover:text-tertiary transition-colors hover:opacity-80 focus:ring-1 focus:ring-tertiary-container rounded px-2 py-1 -ml-2"
                        href="#">Research</a>
                    <a class="text-on-surface-variant hover:text-tertiary transition-colors hover:opacity-80 focus:ring-1 focus:ring-tertiary-container rounded px-2 py-1 -ml-2"
                        href="#">Preservation</a>
                    <a class="text-on-surface-variant hover:text-tertiary transition-colors hover:opacity-80 focus:ring-1 focus:ring-tertiary-container rounded px-2 py-1 -ml-2"
                        href="#">Educational Programs</a>
                    <a class="text-on-surface-variant hover:text-tertiary transition-colors hover:opacity-80 focus:ring-1 focus:ring-tertiary-container rounded px-2 py-1 -ml-2"
                        href="#">Terms of Service</a>
                </div>
            </div>
        </footer>
    </body>

</html>
