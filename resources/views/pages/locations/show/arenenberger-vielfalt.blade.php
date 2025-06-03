<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Arenenberger Vielfalt') }}" 
      description="{{ __('Kapelle') }}"
      number="1"
      visual="visual-arenenberger-vielfalt.png">

      <div class="mt-25">
        <p>{{ __('Erfahren Sie von den Anfängen des Arenenberg als Land- und Weingut und wie dieses sich nach der Schenkung an den Kanton Thurgau zum Ort der Kultur, Bildung und Beratung entwickelt.') }}</p>
      </div>

      <x-accordion.wrapper class="mt-25">
      
        <x-accordion.item 
          title="{{ __('Schlüssel') }}" 
          id="access-code" 
          contentClasses="block w-full pt-10">
          <div class="text-center text-xl tracking-[.3rem]">
            2974
          </div>
        </x-accordion.item>

      </x-accordion.wrapper>

    </x-locations.show>
  @endsection
</x-layout.app>