<div 
	x-cloak 
	x-show="menu"
	class="relative w-full mt-50">
  <x-accordion.wrapper>

    <x-accordion.item 
      title="{{ __('Sprachauswahl') }}" 
      id="language"
      contentClasses="!py-20">
      <div class="flex justify-center gap-45">
        <x-buttons.language route="{{ current_route('de') }}" label="D" active="{{ app()->getLocale() === 'de' }}" />
        <x-buttons.language route="{{ current_route('fr') }}" label="F" active="{{ app()->getLocale() === 'fr' }}" />
        <x-buttons.language route="{{ current_route('en') }}" label="E" active="{{ app()->getLocale() === 'en' }}" />
      </div>
    </x-accordion.item>
  
    <x-accordion.item 
      title="{{ __('Impressum') }}" 
      id="impressum" 
      contentClasses="block w-full !py-20">

      <p>
        {{ __('Redaktion: Kanton Thurgau, Betrieb Arenenberg') }}<br>
        {{ __('Konzept und Inhaltserarbeitung: imRaum, Baden') }}<br>
        {{ __('Konzept und Grafik: Bivgrafik, Zürich') }}<br>
        {{ __('Konzept und Szenografie: Studio DAS, St. Gallen') }}<br>
        {{ __('Illustrationen: Laura Jurt, Zürich') }}
      </p>
      
      <p>
        {{ __('Hörreportagen') }}<br>
        {{ __('Interviews: Annette Fetscherin; Daniel Brogle, Christina Egli, Dominik Gügel, Hansjörg Hauser, Marlis Nölly, Michael Schwarzenberger, Carol Tanner') }}<br>
        {{ __('Tonaufnahmen: Fruitjuicer, Weinfelden') }}<br>
        {{ __('Post-Produktion Audio: kellerthurgau, Frauenfeld') }}<br>
        {{ __('Sprecherinnen und Sprecher F/E : Pascal Holzer (E), Laura Lienhard (F), Ann Malcolm (E), Sophie Richard (F), Suramira Vos (E), Olivier Vuille (F)') }}
      </p>
      
      <p>
        {{ __('Film') }}<br>
        {{ __('Konzept und Animation: Papierboot, Luzern') }}<br>
        {{ __('Sounddesign: Noisy Neighbours, Zürich') }}<br>
        {{ __('Sprecher Film: Marco Caduff') }}
      </p>
      
      <p>
        {{ __('Programmierung: Marcel Stadelmann, Winterthur/Zürich') }}<br>
        {{ __('Übersetzungen: Supertext, Zürich') }}
      </p>
      
      <p>
        {{ __('Geländevorbereitung/Bau: Kanton Thurgau, Betrieb Arenenberg') }}<br>
        {{ __('Vorbereitung Exponate: Kanton Thurgau, Departement für Erziehung und Kultur, Amt für Archäologie') }}<br>
        {{ __('Metallbau: FMT Metallbau, Bettwiesen') }}<br>
        {{ __('AV-Technik: Crystal Display Electronics, Altendorf') }}<br>
        {{ __('Digitaldruck: Capa Werbetechnik, Frauenfeld') }}<br>
        {{ __('Druck Flyer: Fairdruck, Sirnach') }}
      </p>
      
    </x-accordion.item>

  </x-accordion.wrapper>
</div>