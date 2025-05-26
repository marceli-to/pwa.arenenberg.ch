<div 
	x-cloak 
	x-show="menu"
	class="relative w-full mt-50">
  <x-accordion.wrapper>

    {{-- <x-accordion.item 
      title="{{ __('Sprachauswahl') }}" 
      id="language"
      contentClasses="!py-20">
      <div class="flex justify-center gap-45">
        <x-buttons.language route="{{ current_route('de') }}" label="D" active="{{ app()->getLocale() === 'de' }}" />
        <x-buttons.language route="{{ current_route('fr') }}" label="F" active="{{ app()->getLocale() === 'fr' }}" />
        <x-buttons.language route="{{ current_route('en') }}" label="E" active="{{ app()->getLocale() === 'en' }}" />
      </div>
    </x-accordion.item> --}}
  
    <x-accordion.item 
      title="{{ __('Impressum') }}" 
      id="impressum" 
      contentClasses="block w-full !py-20">
      <p>Impressum content goes here.</p>
    </x-accordion.item>

  </x-accordion.wrapper>
</div>