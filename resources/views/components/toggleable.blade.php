@props([
  'title' => '',
])

<div class="mt-25" x-data="{ open: false }">
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