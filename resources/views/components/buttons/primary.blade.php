@props([
  'route' => '#',
  'label' => '',
  'type' => 'link',
  'class' => '',
])
@if ($type === 'link')
  <a 
    href="{{ $route }}" 
    class="w-full text-lg h-50 border-2 border-evergreen flex items-center justify-center hover:text-blush hover:border-crimson hover:bg-crimson transition-all {{ $class }}"
    title="{{ $label }}"
    aria-label="{{ $label }}"
    {!! $attributes !!}>
    <span>{{ $label }}</span>
  </a>
@elseif ($type === 'button')
  <button 
    type="submit" 
    class="w-full text-lg h-50 border-2 border-evergreen flex items-center justify-center hover:text-blush hover:border-crimson hover:bg-crimson transition-all {{ $class }}"
    title="{{ $label }}"
    aria-label="{{ $label }}"
    {!! $attributes !!}>
    <span>{{ $label }}</span>
  </button>
@endif