<x-layout.app>
  @section('content')
    <x-locations.show 
      title="{{ __('Milch mit Zukunft') }}" 
      description="{{ __('Milchviehstall') }}"
      number="2" 
      visual="visual-milch-mit-zukunft.png"
      audio="milch-mit-zukunft.mp3" />

      <div class="my-25">
        <p>{{ __('Hören Sie, welche Technologien die Arenenberger Milchwirtschaft zukunftsweisend machen. Annette Fetscherin unterhält sich mit dem Betriebsleiter Hansjörg Hauser und dem Schulleiter Michael Schwarzenberger.') }}</p>
      </div>
  @endsection
</x-layout.app>