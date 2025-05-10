@if (Route::is('*.page.locations.show'))
  <header class="sticky top-0 py-20 w-full z-40 bg-blush border-b border-b-evergreen">
    <div class="w-full flex justify-between">
      <div>
        <a href="javascript:history.back()" class="block mt-8">
          <x-icons.arrow-left class="w-48 h-auto" />
        </a>
      </div>
      <div class="mt-10">
        <a 
          href="javascript:;"
          @click="menu = !menu"
          class="w-47 h-35 flex items-center justify-center">
          <span x-show="!menu" x-cloak>
            <x-icons.burger class="w-47 h-auto" />
          </span>
          <span x-show="menu" x-cloak>
            <x-icons.cross class="w-35 h-auto" />
          </span>
        </a>
      </div>
    </div>
  </header>
@else
  <header class="sticky top-0 pt-20 w-full z-40 bg-blush">
    <div class="w-full flex justify-between">
      <a
        href="{{ localized_route('page.home') }}"
        class="block"
        title="{{ __('Startseite') }}">
        <h1 class="text-crimson text-2xl leading-none mb-5">
          {!! __('Kaiser, Kühe<br>und Kultur') !!}
        </h1>
        @if (Route::is('*.page.home'))
          <div class="text-crimson text-sm">
            {!! __('Ein Parcours durch die<br>Arenenberger Vielfalt') !!}
          </div>
        @endif
      </a>
      <div class="mt-10">
        <a 
          href="javascript:;"
          @click="menu = !menu"
          class="w-46 h-32 flex items-center justify-center">
          <span x-show="!menu" x-cloak>
            <x-icons.burger class="w-46 h-auto" />
          </span>
          <span x-show="menu" x-cloak>
            <x-icons.cross class="w-32 h-auto" />
          </span>
        </a>
      </div>
    </div>
  </header>
@endif

<x-layout.app.menu.wrapper />