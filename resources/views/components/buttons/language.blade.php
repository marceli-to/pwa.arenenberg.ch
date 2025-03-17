@props([
  'route' => '#',
  'label' => '',
  'active' => false
])
<a 
  href="{{ $route }}" 
  @class([
    'flex items-center justify-center text-xl text-center rounded-full w-64 h-64 text-crimson border-2 border-evergreen transition-colors',
    'bg-crimson text-blush border-crimson' => $active,
  ])
>
  <span>{{ $label }}</span>
</a>