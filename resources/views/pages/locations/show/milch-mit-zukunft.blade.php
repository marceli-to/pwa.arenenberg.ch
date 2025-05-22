<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Milch mit Zukunft') }}" 
      description="{{ __('Milchviehstall') }}"
      number="2" 
      visual="visual-location.png"
      audio="milch-mit-zukunft-en.mp3" />
  @endsection
</x-layout.app>