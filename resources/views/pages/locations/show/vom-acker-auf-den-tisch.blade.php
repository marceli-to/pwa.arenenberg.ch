<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Vom Acker auf den Tisch') }}" 
      description="{{ __('Feldkulturengarten') }}"
      number="3" 
      visual="visual-location.png"
      audio="vom-acker-auf-den-tisch.mp3" />
  @endsection
</x-layout.app>