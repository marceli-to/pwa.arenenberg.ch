@if (Route::is('*.page.locations.show'))
  <header 
    class="py-20 w-full z-40 bg-blush border-b border-b-evergreen"
    :class="{ '!border-b-0': menu }">
    <div class="w-full flex justify-between">
      <div>
        <a href="{{ localized_route('page.locations.list') }}" class="block mt-8">
          <x-icons.arrow-left class="w-48 h-auto" />
        </a>
      </div>
      <div class="mt-10">
        <a 
          href="javascript:;"
          @click="menu = !menu"
          class="w-47 h-35 flex items-center justify-center">
          <span x-show="!menu" x-cloak>
            <x-icons.burger class="w-47 h-29 grow-0" />
          </span>
          <span x-show="menu" x-cloak>
            <x-icons.cross class="w-35 h-auto grow-0" />
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
            {!! __('Ein Parcours durch<br>die Arenenberger Vielfalt') !!}
          </div>
        @endif
      </a>
      <div class="mt-10">
        <a 
          href="javascript:;"
          @click="menu = !menu"
          class="w-47 h-35 flex items-center justify-center">
          <span x-show="!menu" x-cloak>
            <x-icons.burger class="w-47 h-29 grow-0" />
          </span>
          <span x-show="menu" x-cloak>
            <x-icons.cross class="w-35 h-auto grow-0" />
          </span>
        </a>
      </div>
    </div>
  </header>
@endif
<x-layout.app.menu.wrapper />