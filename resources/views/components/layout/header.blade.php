<header>
  <x-layout.inner>
    <div class="w-full flex flex-col justify-between">
      @if (Route::is('auth.*'))
        <h1>DASHBOARD</h1>
      @else
        <h1 class="text-crimson text-xl leading-none">
          {{ __('Kaiser, Kühe und Kultur') }}
        </h1>
      @endif
      <nav>
        <ul>
          <li>
            <a href="{{ localized_route('page.locations') }}">
              {{ __('Standorte') }}
            </a>
          </li>
        </ul>
    </div>
  </x-layout.inner>
</header>
