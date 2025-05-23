<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Arenenberger Vielfalt') }}" 
      description="{{ __('Kapelle') }}"
      number="1"
      visual="visual-arenenberger-vielfalt"
      audio="arenenberger-vielfalt-en.mp3">

      <div class="mt-25">
        <p>{{ __('Erfahren Sie von den Anfängen des Arenenberg als Land- und Weingut und wie dieses sich nach der Schenkung an den Kanton Thurgau zum Ort der Kultur, Bildung und Beratung entwickelt.') }}</p>
      </div>

      <x-accordion.wrapper class="mt-25">
      
        <x-accordion.item 
          title="{{ __('Schlüssel') }}" 
          id="access-code" 
          contentClasses="block w-full pt-10">
          <div class="text-center text-xl mt-20 tracking-[.3rem]">
            5826
          </div>
        </x-accordion.item>

      </x-accordion.wrapper>

      <x-toggleable title="{{ __('Bildnachweise') }}">
        <p>
          <strong>
            {{ __('Hortense de Beaurnhais') }}
          </strong><br>
          {{ __('François Baron Gérard, Hortense de Beauharnais, Napoleon Museum Thurgau, Schloss und Park Arenenberg/Daniel Steiner') }}
        </p>

        <p>
          <strong>
            {{ __('Hermann Fürst von Pückler-Muskau') }}
          </strong><br>
          {{ __('Porträt Hermann Fürst von Pückler-Muskau in preussischer Uniform, Öl auf Leinwand, August Gosch nach Franz Krüger, 1846, Inv.-Nr.: GFPB-043, mit Genehmi-gung der Gräflichen Familie von Pückler in Branitz, © Stiftung Fürst-Pückler-Museum Park und Schloss Branitz') }}
        </p>

        <p>
          <strong>
            {{ __('Napoléon III.') }}
          </strong><br>
          {{ __('Felix Cottr(e)au, Prinz Louis Napoléon im Park von Schloss Arenenberg.') }}
        </p>
      </x-toggleable>

    </x-locations.show>
  @endsection
</x-layout.app>