@props([
  'route' => '#',
  'label' => '',
  'active' => false
])
<a 
  href="{{ $route }}" 
  @class([
    'flex items-center justify-center text-2xl text-center rounded-full w-64 h-64 border-crimson border-2 transition-colors',
    'bg-crimson text-blush' => $active,
    'bg-blush text-crimson' => !$active
  ])
>
  <span>{{ $label }}</span>
</a>