@props(['value'])
<label class="block leading-none text-lg">
  {{ $value ?? $slot }}
</label>