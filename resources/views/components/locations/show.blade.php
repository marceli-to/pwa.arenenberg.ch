@props([
  'title' => '',
  'description' => '',
  'number' => '',
  'visual' => '',
  'audio' => ''
])
<div class="w-full pt-15 mb-45">
  <div class="flex flex-col gap-y-15 justify-between">
    <figure>
      <img src="/img/{{ $visual }}" alt="{{ $title }}" width="698" height="956" class="aspect-square w-full h-auto object-contain">
    </figure>
    <div class="pt-5 pb-10 border-y border-y-evergreen">
      <h1 class="text-xl flex justify-between mb-2">
        <span>{{ $title }}</span>
        @include('components.icons.numbers.green.' . $number, ['class' => 'w-30 h-auto mt-2'])
      </h1>
      <p class="text-md">
        {{ $description }}
      </p>
    </div>
    @if ($audio !== '')
      <div>
        <x-audio.player src="{{ $audio }}" />
      </div>
    @endif
  </div>
  {{ $slot }}
</div>