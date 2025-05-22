<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Kaiserliches Leben') }}" 
      description="{{ __('Grabplatte') }}"
      number="5"
      visual="visual-location.png"
      audio="kaiserliches-leben-en.mp3" />

      <div class="mt-25">
        <p>{{ __('Bringen Sie in Erfahrung, wie die französische Kaiserfamilie am Arenenberg heimisch wird und die Gegend am Untersee bis heute prägt. Annette Fetscherin informiert sich bei der Museumsmitarbeiterin Christina Egli.') }}</p>
      </div>
  @endsection
</x-layout.app>