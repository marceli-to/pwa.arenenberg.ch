@if (Route::is('*.page.locations.show'))
  <header class="sticky top-0 py-20 w-full z-40 bg-blush border-b border-b-evergreen">
    <div class="w-full flex justify-between">
      <div>
        <a href="javascript:history.back()" class="block mt-15">
          <x-icons.arrow-left class="w-50 h-auto" />
        </a>
      </div>
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
@else
  <header class="sticky top-0 pt-20 w-full z-40 bg-blush">
    <div class="w-full flex justify-between">
      <a
        href="{{ localized_route('page.home') }}"
        class="block"
        title="{{ __('Startseite') }}">
        <h1 class="text-crimson text-xl leading-none">
          {!! __('Kaiser, Kühe<br>und Kultur') !!}
        </h1>
        <div class="text-crimson">
          {!! __('Ein Parcours durch die<br>Arenenberger Vielfalt') !!}
        </div>
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