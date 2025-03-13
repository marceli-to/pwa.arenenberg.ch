<!doctype html>
<html
  lang="{{ locale() }}"
  class="scroll-smooth overflow-y-auto">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | {{ __(env('APP_NAME')) }}</title>
<meta name="description" content="Dashboard | {{ __(env('APP_DESCRIPTION')) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
@vite('resources/css/app.css')
</head>
<body class="antialiased font-gt-alpina-medium text-md text-evergreen flex flex-col min-h-dvh bg-blush">
