@props(['value'])
<label class="block leading-none text-xl">
  {{ $value ?? $slot }}
</label>