<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Vom Acker auf den Tisch') }}" 
      description="{{ __('Feldkulturengarten') }}"
      number="3" 
      visual="visual-location.png"
      audio="vom-acker-auf-den-tisch-en.mp3" />

      <div class="mt-25">
        <p>{{ __('Vernehmen Sie, welche Innovationen am Arenenberg für einen produktiven und nachhaltigen Pflanzenbau entwickelt werden. Annette Fetscherin ist im Gespräch mit den Beraterinnen Carol Tanner und Marlis Nölly.') }}</p>
      </div>

  @endsection
</x-layout.app>