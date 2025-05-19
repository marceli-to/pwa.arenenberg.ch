@props([
  'route',
  'title' => '',
  'description' => '',
  'number' => '',
])
<a 
  href="{{ $route }}" 
  class="flex justify-between gap-x-24 border-t border-t-evergreen last-of-type:border-b last-of-type:border-b-evergreen py-10"
  title="{{ $title }}">
  <span>
    <h2 class="text-xl mb-2">
    {{ $title }}
    </h2>
    <p class="text-md">
      {{ $description }}
    </p>
  </span>
  <span>
    @include('components.icons.numbers.green.' . $number, ['class' => 'w-29 h-auto'])
  </span>
</a>