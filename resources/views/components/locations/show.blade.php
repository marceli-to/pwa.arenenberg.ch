@props([
  'title' => '',
  'number' => '',
  'visual' => '',
  'audio' => ''
])
<div class="w-full h-[calc(100dvh_-_190px)] mt-25 flex flex-col justify-between">
  <figure class="h-[calc(100dvh_-_335px)]">
    <img src="/img/{{ $visual }}" alt="{{ $title }}" width="698" height="956" class="w-full h-full object-contain">
  </figure>
  <h1 class="text-lg flex justify-between py-15 border-y border-y-evergreen">
    <span>{{ $title }}</span>
    <span>{{ $number }}</span>
  </h1>
  <div class="mt-10">
    <x-audio.player src="{{ $audio }}" />
  </div>
  {{ $slot }}
</div>