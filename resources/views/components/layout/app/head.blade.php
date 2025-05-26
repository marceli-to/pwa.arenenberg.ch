<!doctype html>
<html
  lang="{{ app()->getLocale() }}"
  class="scroll-smooth"
  x-data="{ menu: false }">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ __(env('APP_NAME')) }}</title>
<meta name="description" content="{{ __(env('APP_DESCRIPTION')) }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="{{ __(env('APP_NAME')) }}" />
<link rel="manifest" href="/site.webmanifest" />
@vite('resources/css/app.css')
</head>
<body class="antialiased font-gt-alpina-medium text-md leading-[1.2] text-evergreen bg-blush max-w-lg mx-auto px-15  overflow-y-auto">
