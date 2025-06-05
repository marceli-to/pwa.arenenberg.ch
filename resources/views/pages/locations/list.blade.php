<x-layout.app>
  @section('content')
  <div 
    class="w-full mt-50 flex flex-col justify-between gap-y-25 pb-100">
    <div>
      <x-locations.list-item 
        route="{{ localized_route('page.locations.show', Str::slug('Arenenberger Vielfalt')) }}"
        title="{{ __('Arenenberger Vielfalt') }}" 
        description="{{ __('Kapelle') }}"
        number="1" />
    
      <x-locations.list-item 
        route="{{ localized_route('page.locations.show', Str::slug('Milch mit Zukunft')) }}"
        title="{{ __('Milch mit Zukunft') }}" 
        description="{{ __('Milchviehstall') }}"
        number="2" />
      
      <x-locations.list-item 
        route="{{ localized_route('page.locations.show', Str::slug('Vom Acker auf den Tisch')) }}"
        title="{{ __('Vom Acker auf den Tisch') }}" 
        description="{{ __('Feldkulturengarten') }}"
        number="3" />
      
      <x-locations.list-item 
        route="{{ localized_route('page.locations.show', Str::slug('Wundervolle Gartenwelt')) }}"
        title="{{ __('Wundervolle Gartenwelt') }}" 
        description="{{ __('Eremitage') }}"
        number="4" />
      
      <x-locations.list-item 
        route="{{ localized_route('page.locations.show', Str::slug('Kaiserliches Leben')) }}"
        title="{{ __('Kaiserliches Leben') }}" 
        description="{{ __('Grabplatte') }}"
        number="5" />
    </div>
    
    <div class="fixed bottom-25 w-full left-1/2 -translate-x-1/2">
      <x-buttons.primary 
        route="{{ localized_route('page.locations.map') }}"
        type="link"
        label="{{ __('Karte') }}">
      </x-buttons.primary>
    </div>
  </div>
  @endsection
</x-layout.app>