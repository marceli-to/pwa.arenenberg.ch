@props(['value'])
<label class="block leading-none text-sm">
  {{ $value ?? $slot }}
</label>