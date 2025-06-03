<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Wundervolle Gartenwelt') }}" 
      description="{{ __('Eremitage') }}"
      number="4" 
      visual="visual-wundervolle-gartenwelt.png"
      audio="wundervolle-gartenwelt.mp3" />

      <div class="my-25">
        <p>{{ __('Erfahren Sie Wissenswertes über die Entstehung und die Bedeutung des Arenenberger Landschaftsparks. Annette Fetscherin befragt den Museumsdirektor Dominik Gügel und den Landschaftsgärtner Daniel Brogle. ') }}</p>
      </div>

      <x-toggleable title="{{ __('Bildnachweise') }}">
        <p>
          <strong>
            {{ __('Hortense de Beauharnais') }}
          </strong><br>
          {{ __('François Baron Gérard, Hortense de Beauharnais, Napoleon Museum Thurgau, Schloss und Park Arenenberg/Daniel Steiner') }}
        </p>

        <p>
          <strong>
            {{ __('Hermann von Pückler-Muskau') }}
          </strong><br>
          {{ __('Porträt Hermann Fürst von Pückler-Muskau in preussischer Uniform, Öl auf Leinwand, August Gosch nach Franz Krüger, 1846, Inv.-Nr.: GFPB-043, mit Genehmigung der Gräflichen Familie von Pückler in Branitz, © Stiftung Fürst-Pückler-Museum Park und Schloss Branitz') }}
        </p>

        <p>
          <strong>
            {{ __('Napoléon III') }}
          </strong><br>
          {{ __('Felix Cottr(e)au, Prinz Louis Napoléon im Park von Schloss Arenenberg, Napoleon Museum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Park Arenenberg um 1817') }}
          </strong><br>
          {{ __('Hortense de Beauharnais, Arenenberg und Salenstein von Südwesten, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Flächenplan Schlossgut Arenenberg um 1835') }}
          </strong><br>
          {{ __('Flächenplan des Schlossgutes Arenenberg, 1835, Staatsarchiv des Kantons Thurgau, StATG Slg. 1, K/P 02421') }}
        </p>

        <p>
          <strong>
            {{ __('Die Eremitage um 1860') }}
          </strong><br>
          {{ __('Nach Egidius Federle, Die Eremitage, 1860, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

      </x-toggleable>
      
  @endsection
</x-layout.app>