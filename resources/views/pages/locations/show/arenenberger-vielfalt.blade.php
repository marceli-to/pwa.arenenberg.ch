<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Arenenberger Vielfalt') }}" 
      number="1"
      visual="visual-location.png"
      audio="arenenberger-vielfalt.mp3">

      <div class="mt-25">
        <p>{{ __('Lore ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}</p>
      </div>

      <x-accordion.wrapper class="mt-40">
      
        <x-accordion.item 
          title="{{ __('Türcode') }}" 
          id="access-code" 
          contentClasses="block w-full pt-10 border-t border-t-evergreen">
          <p>Lore ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempo.</p>
          <div class="text-center text-lg mt-30">
            5826
          </div>
        </x-accordion.item>
      
        <x-accordion.item
          title="{{ __('Bildquellen') }}" 
          id="bildquellen" 
          contentClasses="block w-full pt-10 border-t border-t-evergreen">
          <p>Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich in seinem Bett zu einem ungeheueren Ungeziefer verwandelt. Und es war ihnen wie eine Bestätigung ihrer neuen Träume und guten Absichten, als am Ziele ihrer Fahrt die Tochter als erste sich erhob und ihren jungen Körper dehnte.</p>
          <p>»Es ist ein eigentümlicher Apparat«, sagte der Offizier zu dem Forschungsreisenden und überblickte mit einem gewissermaßen bewundernden Blick den ihm doch wohlbekannten Apparat. Sie hätten noch ins Boot springen können, aber der Reisende hob ein schweres, geknotetes Tau vom Boden, drohte ihnen damit und hielt sie dadurch von dem Sprunge ab.</p>
          <p>Als Gregor Samsa eines Morgens aus unruhigen Träumen erwachte, fand er sich in seinem Bett zu einem ungeheueren Ungeziefer verwandelt. Und es war ihnen wie eine Bestätigung ihrer neuen Träume und guten Absichten, als am Ziele ihrer Fahrt die Tochter als erste sich erhob und ihren jungen Körper dehnte.</p>
          <p>»Es ist ein eigentümlicher Apparat«, sagte der Offizier zu dem Forschungsreisenden und überblickte mit einem gewissermaßen bewundernden Blick den ihm doch wohlbekannten Apparat. Sie hätten noch ins Boot springen können, aber der Reisende hob ein schweres, geknotetes Tau vom Boden, drohte ihnen damit und hielt sie dadurch von dem Sprunge ab.</p>
        </x-accordion.item>
      </x-accordion.wrapper>

    </x-locations.show>
  @endsection
</x-layout.app>