@props([
  'route' => '#',
  'label' => '',
])
<a href="{{ $route }}" class="text-lg h-50 border-2 border-evergreen flex items-center justify-center">
  <span>{{ $label }}</span>
</a>