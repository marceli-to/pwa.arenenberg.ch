@props(['status', 'type' => 'success'])
@if ($status)
<div 
  x-data="{ show: true }"
  x-on:click="show = false"
  @if ($type !== 'error')
  x-init="setTimeout(() => show = false, 3000)"
  @endif
  x-show="show"
  class="fixed z-[9999] text-sm w-full text-white top-0 left-0 cursor-pointer"
  data-toast>
  <div
    @class([
      'text-center min-h-32 flex items-center justify-center',
      'bg-green-200' => $type == 'success',
      'bg-red-600' => $type == 'error',
      'bg-blue-200' => $type == 'info',
    ])>
    {{ $status }}
  </div>
</div>
@endif
