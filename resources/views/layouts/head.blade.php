<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>ScienceWeb | @yield('title')</title>
    <meta name="description" content="@yield('page-description', 'ScienceWeb - База Научных исследований и публикаций в Центральной Азии')"/>
    <meta name="keywords" content="@yield('page-keywords', '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <link rel="canonical" href="Replace_with_your_PAGE_URL" />--}}

    <!-- Article meta tags -->
    @yield('meta')
    <!-- Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="ScienceWeb | @yield('title')" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:site_name" content="ScienceWeb" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description" content="@yield('page-description', 'ScienceWeb - База Научных исследований и публикаций в Центральной Азии')" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Add site Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <meta name="msapplication-TileImage" content="images/favicon.png" />

    <!-- Structured Data  -->
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "name": "ScienceWeb",
  "url": "https://scienceweb.uz"
}
</script>
    @yield('styles')
    <style>
        .main-body {
            padding: 15px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm >.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }
        .h-100 {
            height: 100%!important;
        }
        .shadow-none {
            box-shadow: none!important;
        }

        .big-font {
            font-size: 30px;
        }
    </style>
</head>

<body>

<div class="page-wrapper">
