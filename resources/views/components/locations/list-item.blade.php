@props([
  'route',
  'title' => '',
  'description' => '',
  'number' => '',
])
<a 
  href="{{ $route }}" 
  class="flex justify-between border-t border-t-evergreen last-of-type:border-b last-of-type:border-b-evergreen py-10"
  title="{{ $title }}">
  <span>
  <h2 class="text-lg">
   {{ $title }}
  </h2>
  <p class="text-md">
    {{ $description }}
  </p>
  </span>
  <span class="text-lg">
    {{ $number }}
  </span>
</a>