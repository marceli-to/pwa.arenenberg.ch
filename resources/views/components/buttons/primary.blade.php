@props([
  'route' => '#',
  'label' => '',
  'type' => 'link',
  'class' => '',
])
@if ($type === 'link')
  <a 
    href="{{ $route }}" 
    class="w-full max-w-[290px] mx-auto text-xl h-50 border-2 border-evergreen rounded-full flex items-center justify-center hover:text-blush hover:border-crimson hover:bg-crimson {{ $class }}"
    title="{{ $label }}"
    aria-label="{{ $label }}"
    {!! $attributes !!}>
    <span>{{ $label }}</span>
  </a>
@elseif ($type === 'button')
  <button 
    type="submit" 
    class="w-full max-w-[290px] mx-auto text-xl h-50 border-2 border-evergreen rounded-full flex items-center justify-center hover:text-blush hover:border-crimson hover:bg-crimson {{ $class }}"
    title="{{ $label }}"
    aria-label="{{ $label }}"
    {!! $attributes !!}>
    <span>{{ $label }}</span>
  </button>
@endif