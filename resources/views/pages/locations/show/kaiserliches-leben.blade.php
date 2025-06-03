<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Kaiserliches Leben') }}" 
      description="{{ __('Grabplatte') }}"
      number="5"
      visual="visual-kaiserliches-leben.png"
      audio="kaiserliches-leben.mp3" />

      <div class="mt-25">
        <p>{{ __('Bringen Sie in Erfahrung, wie die französische Kaiserfamilie am Arenenberg heimisch wird und die Gegend am Untersee bis heute prägt. Annette Fetscherin informiert sich bei der Museumsmitarbeiterin Christina Egli.') }}</p>
      </div>

      <x-accordion.wrapper class="mt-25">
      
        <x-accordion.item 
          title="{{ __('Schlüssel') }}" 
          id="access-code" 
          contentClasses="block w-full pt-10">
          <div class="text-center text-xl tracking-[.3rem]">
            5364
          </div>
        </x-accordion.item>

      </x-accordion.wrapper>

      <x-toggleable title="{{ __('Bildnachweise') }}">

        <p>
          <strong>
            {{ __('Architektur') }}
          </strong><br>
          {{ __('Anonym, Anbau von Schloss Arenenberg mit Wintergarten, um 1820, Rueil-Malmaison, Châteaux de Malmaison et Bois-Préau/ Marie-Pierre Moinet') }}
        </p>

        <p>
          <strong>
            {{ __('Gartenarchitektur (1)') }}
          </strong><br>
          {{ __('Hortense de Beauharnais, um 1825, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Gartenarchitektur (2)') }}
          </strong><br>
          {{ __('Abschied von Napoleon I. und Hortense de Beauharnais im Schlosspark von Malmaison (1815), freie Interpretation der Szene aus späterer Zeit, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Gartenarchitektur (3)') }}
          </strong><br>
          {{ __('Hortense de Beauharnais, Château de Saint Leu von der Parkseite aus, um 1815, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Gesellschaft (1)') }}
          </strong><br>
          {{ __('Ary Scheffer, Serenade auf Arenenberg, nach 1832, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Innenarchitektur') }}
          </strong><br>
          {{ __('Unbekannt, Blick in den Zeltsalon von Schloss Arenenberg, ohne Datum, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>
        
        <p>
          <strong>
            {{ __('Wohnkultur') }}
          </strong><br>
          {{ __('Champagnerflöte, Manufacture Mont-Cenis, Creusot, nach 1815, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Gesellschaft (2)') }}
          </strong><br>
          {{ __('Felix Cottr(e)au, Die Bibliothek auf Schloss Arenenberg, nach 1832, Rueil-Malmaison, Châteaux de Malmaison et Bois-Préau/ Marie-Pierre Moinet') }}
        </p>
                
        <p>
          <strong>
            {{ __('Literatur') }}
          </strong><br>
          {{ __('Louis Napoléon und Monsieur de Chateaubriand, Darstellung frei interpretiert, nach 1832, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Politik') }}
          </strong><br>
          {{ __('Franz Xaver Winterhalter, Kaiserin Eugénie, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Musik') }}
          </strong><br>
          {{ __('Unbekannt, Hortense de Beauharnais singend, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

        <p>
          <strong>
            {{ __('Mode') }}
          </strong><br>
          {{ __('Felix Cottr(e)au, Hortense de Beauharnais im Gotischen Haus (heute Kapelle) auf Arenenberg, um 1834, Napoleonmuseum Thurgau, Schloss und Park Arenenberg') }}
        </p>

      </x-toggleable>
  @endsection
</x-layout.app>