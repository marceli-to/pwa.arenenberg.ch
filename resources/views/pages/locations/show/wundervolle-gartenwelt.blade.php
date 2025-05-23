<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Wundervolle Gartenwelt') }}" 
      description="{{ __('Eremitage') }}"
      number="4" 
      visual="visual-wundervolle-gartenwelt.png"
      audio="wundervolle-gartenwelt-en.mp3" />

      <div class="my-25">
        <p>{{ __('Erfahren Sie Wissenswertes über die Entstehung und die Bedeutung des Arenenberger Landschaftsparks. Annette Fetscherin befragt den Museumsdirektor Dominik Gügel und den Landschaftsgärtner Daniel Brogle. ') }}</p>
      </div>

  @endsection
</x-layout.app>