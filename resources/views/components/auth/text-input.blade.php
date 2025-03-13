@props(['disabled' => false])
<input 
  {{ $disabled ? 'disabled' : '' }} 
  {!! $attributes->merge() !!}
  x-data
  @focus="$el.removeAttribute('data-error'); document.querySelector('[data-toast]') ? document.querySelector('[data-toast]').style.display = 'none' : null;"
  @class([
    'w-full min-h-40 text-md !ring-0 px-0 py-2 px-8',
    'border-evergreen rounded-sm',
    'focus:!border-evergreen focus:bg-white focus:text-evergreen',
    'focus:placeholder:text-evergreen',
    'placeholder:text-evergreen placeholder:',
    'data-[error=true]:text-white',
    'data-[error=true]:bg-red-600',
    'data-[error=true]:border-red-600',
    'data-[error=true]:placeholder:text-white'
  ])
>