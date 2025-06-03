@props([
  'title' => '',
])

<div class="pb-45" x-data="{ open: false }">
  <a 
    href="javascript:;" 
    @click="open = !open"
    class="font-gt-alpina-bold font-normal underline underline-offset-5">
    {{ $title }}
  </a>
  <div 
    x-cloak 
    x-show="open"
    class="mt-20">
    {{ $slot }}
  </div>
</div>