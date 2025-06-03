<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Milch mit Zukunft') }}" 
      description="{{ __('Milchviehstall') }}"
      number="2" 
      visual="visual-milch-mit-zukunft.png"
      audio="milch-mit-zukunft.mp3">

      <div class="mt-25">
        <p>{{ __('Hören Sie, welche Technologien die Arenenberger Milchwirtschaft zukunftsweisend machen. Annette Fetscherin unterhält sich mit dem Betriebsleiter Hansjörg Hauser und dem Schulleiter Michael Schwarzenberger.') }}</p>
      </div>

      <x-accordion.wrapper class="mt-25">
      
        <x-accordion.item 
          title="{{ __('Schlüssel') }}" 
          id="access-code" 
          contentClasses="block w-full pt-10">
          <div class="text-center text-xl tracking-[.3rem]">
            4529
          </div>
        </x-accordion.item>

      </x-accordion.wrapper>

    </x-locations.show>
    
  @endsection
</x-layout.app>