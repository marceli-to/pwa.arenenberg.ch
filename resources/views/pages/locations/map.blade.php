<x-layout.app>
  @section('content')
  <div 
    class="w-full h-[calc(100dvh_-_175px)] mt-50 flex flex-col justify-between">
    <x-locations.map />
    <div>
      <x-buttons.primary 
        route="{{ localized_route('page.locations.list') }}"
        type="link"
        label="{{ __('Liste') }}">
      </x-buttons.primary>
    </div>
  </div>
  @endsection
</x-layout.app>