<x-layout.app>
  @section('content')
  <div 
    class="w-full mt-50 flex flex-col justify-between">
    <x-locations.map />
  </div>
  
  <div class="fixed bottom-25 w-full left-1/2 -translate-x-1/2">
    <x-buttons.primary 
      route="{{ localized_route('page.locations.list') }}"
      type="link"
      label="{{ __('Liste') }}"
      class="absolute bottom-36 left-1/2 -translate-x-1/2">
    </x-buttons.primary>
  </div>
  @endsection
</x-layout.app>