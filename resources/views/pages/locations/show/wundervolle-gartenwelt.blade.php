<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Wundervolle Gartenwelt') }}" 
      description="{{ __('Eremitage') }}"
      number="4" 
      visual="visual-location.png"
      audio="wundervolle-gartenwelt-en.mp3" />
  @endsection
</x-layout.app>