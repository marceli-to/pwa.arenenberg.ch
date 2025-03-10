<header>
  <x-layout.inner>
    <div class="w-full flex justify-between">
      @if (Route::is('auth.*'))
        <h1>DASHBOARD</h1>
      @else
        <h1 class="text-crimson text-3xl">
          {{ __('Kaiser, Kühe und Kultur') }}
        </h1>
      @endif
    </div>
  </x-layout.inner>
</header>
