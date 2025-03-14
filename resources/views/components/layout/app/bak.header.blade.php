<header>
  <x-layout.inner>
    <div class="w-full flex flex-col justify-between">
      <h1 class="text-crimson text-xl leading-none">
        {!! __('Kaiser, Kühe<br>und Kultur') !!}
      </h1>

      <nav {{ $attributes->merge(['class' => '']) }}>
        <ul class="flex gap-x-24 lg:gap-x-20">
          <li>
            <a 
              href="{{ Request::routeIs('page.home') ? '/' : current_route('de') }}"
              class="{{ app()->getLocale() === 'de' ? 'is-active' : '' }}">de</a>
          </li>
          <li>
            <a 
              href="{{ Request::routeIs('page.home') ? '/fr' : current_route('fr') }}"
              class="{{ app()->getLocale() === 'fr' ? 'is-active' : '' }}">fr</a>
          </li>
          <li>
            <a 
              href="{{ Request::routeIs('page.home') ? '/en' : current_route('en') }}"
              class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">en</a>
          </li>
        </ul>
      </nav>
      <a 
        href="{{ localized_route('page.locations') }}">
        {{ __('Standorte') }}
      </a>
    </div>
  </x-layout.inner>
</header>
