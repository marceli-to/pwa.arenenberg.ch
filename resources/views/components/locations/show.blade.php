@props([
  'title' => '',
  'number' => '',
  'visual' => ''
])
<div class="w-full h-[calc(100dvh_-_215px)] mt-50 flex flex-col justify-between">
  <figure class="h-[calc(100dvh_-_360px)] mt-10">
    <img src="/img/{{ $visual }}" alt="{{ $title }}" width="698" height="956" class="w-full h-full object-contain">
  </figure>
  <h1 class="text-lg flex justify-between py-15 border-y border-y-evergreen">
    <span>{{ $title }}</span>
    <span>{{ $number }}</span>
  </h1>

  <!-- audio player -->
  <div>
    {{ $slot }}
  </div>

</div>