<button {{ $attributes->merge(['type' => 'submit', 'class' => 'border border-evergreen bg-evergreen rounded-sm min-h-40 text-md text-white w-full flex items-center justify-start gap-x-12 px-8 !ring-0 !outline-none transition-all']) }}>
  {{ $slot }}
</button>
