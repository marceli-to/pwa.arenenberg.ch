@props([
  'route' => '#',
  'label' => '',
  'active' => false
])
<a 
  href="{{ $route }}" 
  @class([
    'flex items-center justify-center text-xl text-center rounded-full w-64 h-64 border-2 transition-colors',
    'bg-crimson text-blush border-crimson' => $active,
    'bg-blush text-crimson border-evergreen' => !$active
  ])
>
  <span>{{ $label }}</span>
</a>