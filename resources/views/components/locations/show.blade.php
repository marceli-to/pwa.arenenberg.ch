@props([
  'title' => '',
  'description' => '',
  'number' => '',
  'visual' => '',
  'audio' => ''
])
<div class="w-full min-h-[calc(100dvh_-_190px)] pt-15 pb-30">
  <div class="flex flex-col gap-y-15 justify-between">
    <figure class="h-[calc(100dvh_-_335px)]">
      <img src="/img/{{ $visual }}" alt="{{ $title }}" width="698" height="956" class="w-full h-full object-contain">
    </figure>
    <div class="pt-5 pb-10 border-y border-y-evergreen">
      <h1 class="text-xl flex justify-between mb-2">
        <span>{{ $title }}</span>
        @include('components.icons.numbers.' . $number, ['class' => 'w-30 h-auto mt-2'])
      </h1>
      <p class="text-md">
        {{ $description }}
      </p>
    </div>
    <div>
      <x-audio.player src="{{ $audio }}" />
    </div>
  </div>
  {{ $slot }}
</div>