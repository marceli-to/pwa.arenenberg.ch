<div 
	x-cloak 
	x-show="menu"
	class="relative w-full mt-50">
  <x-accordion.wrapper>

    <x-accordion.item 
      title="{{ __('Sprachauswahl') }}" 
      id="language">
      <div class="flex justify-center gap-45">
        <x-buttons.language route="{{ current_route('de') }}" label="D" active="{{ app()->getLocale() === 'de' }}" />
        <x-buttons.language route="{{ current_route('fr') }}" label="F" active="{{ app()->getLocale() === 'fr' }}" />
        <x-buttons.language route="{{ current_route('en') }}" label="E" active="{{ app()->getLocale() === 'en' }}" />
      </div>
    </x-accordion.item>
  
    <x-accordion.item 
      title="{{ __('Impressum') }}" 
      id="impressum" 
      contentClasses="block w-full">
      <p>Impressum content goes here.</p>
    </x-accordion.item>
  
    <x-accordion.item
      title="{{ __('Bildquellen') }}" 
      id="bildquellen" 
      contentClasses="block w-full">
      <p>Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich in seinem Bett zu einem ungeheueren Ungeziefer verwandelt. Und es war ihnen wie eine Bestätigung ihrer neuen Träume und guten Absichten, als am Ziele ihrer Fahrt die Tochter als erste sich erhob und ihren jungen Körper dehnte.</p>
      <p>»Es ist ein eigentümlicher Apparat«, sagte der Offizier zu dem Forschungsreisenden und überblickte mit einem gewissermaßen bewundernden Blick den ihm doch wohlbekannten Apparat. Sie hätten noch ins Boot springen können, aber der Reisende hob ein schweres, geknotetes Tau vom Boden, drohte ihnen damit und hielt sie dadurch von dem Sprunge ab.</p>
      <p>Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich in seinem Bett zu einem ungeheueren Ungeziefer verwandelt. Und es war ihnen wie eine Bestätigung ihrer neuen Träume und guten Absichten, als am Ziele ihrer Fahrt die Tochter als erste sich erhob und ihren jungen Körper dehnte.</p>
      <p>»Es ist ein eigentümlicher Apparat«, sagte der Offizier zu dem Forschungsreisenden und überblickte mit einem gewissermaßen bewundernden Blick den ihm doch wohlbekannten Apparat. Sie hätten noch ins Boot springen können, aber der Reisende hob ein schweres, geknotetes Tau vom Boden, drohte ihnen damit und hielt sie dadurch von dem Sprunge ab.</p>
    </x-accordion.item>
  </x-accordion.wrapper>
</div>