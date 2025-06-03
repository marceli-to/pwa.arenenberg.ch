<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Vom Acker auf den Tisch') }}" 
      description="{{ __('Feldkulturengarten') }}"
      number="3" 
      visual="visual-vom-acker-auf-den-tisch.png"
      audio="vom-acker-auf-den-tisch.mp3">

      <div class="my-25">
        <p>{{ __('Vernehmen Sie, welche Innovationen am Arenenberg für einen produktiven und nachhaltigen Pflanzenbau entwickelt werden. Annette Fetscherin ist im Gespräch mit den Beraterinnen Carol Tanner und Marlis Nölly.') }}</p>
      </div>

    </x-locations.show>
  @endsection
</x-layout.app>