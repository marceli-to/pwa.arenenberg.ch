<!doctype html>
<html
  lang="{{ locale() }}"
  class="scroll-smooth overflow-y-auto">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ env('APP_NAME') }}</title>
<meta name="description" content="{{ env('APP_DESCRIPTION') }}">
<meta property="og:title" content="{{ env('APP_NAME') }}">
<meta property="og:description" content="{{ env('APP_DESCRIPTION') }}">
<meta property="og:url" content="{{ url()->current()}}">
<meta property="og:site_name" content="{{ env('APP_NAME') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}" />
<link rel="manifest" href="/site.webmanifest" />
@vite('resources/css/app.css')
</head>
<body class="antialiased font-gt-alpina-medium text-evergreen flex flex-col min-h-dvh bg-blush max-w-md mx-auto">