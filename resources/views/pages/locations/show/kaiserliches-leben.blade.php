<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Kaiserliches Leben') }}" 
      description="{{ __('Grabplatte') }}"
      number="5"
      visual="visual-location.png"
      audio="kaiserliches-leben.mp3" />
  @endsection
</x-layout.app>