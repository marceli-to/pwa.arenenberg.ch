@props(['disabled' => false])
<input 
  {{ $disabled ? 'disabled' : '' }} 
  {!! $attributes->merge() !!}
  x-data
  @focus="$el.removeAttribute('data-error'); document.querySelector('[data-toast]') ? document.querySelector('[data-toast]').style.display = 'none' : null;"
  @class([
    'w-full min-h-default text-md !ring-0 px-0 py-2 px-8',
    'border-graphite',
    'focus:!border-black focus:bg-white focus:text-black',
    'focus:placeholder:text-graphite',
    'placeholder:text-graphite placeholder:',
    'data-[error=true]:text-white',
    'data-[error=true]:bg-flame',
    'data-[error=true]:border-flame',
    'data-[error=true]:placeholder:text-white'
  ])
>