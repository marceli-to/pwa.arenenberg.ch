<x-layout.app>
  @section('content')
  <!-- Success section -->
  <div 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen hidden flex-col justify-between"
    data-success-section>
    <div class="text-lg py-10">
      <p>{{ __('Auf Reportage auf dem Arenenberg!') }}</p>
      <p>{{ __('Hinweis zum Rundgang mit Reporter:innen.') }}</p>
      <p>{{ __('Zudem einige Informationen zur Reihenfolge und Ablaufs. Falls Unklarheiten bestehen melden Sie sich bei der Kasse.') }}</p>
      <p class="mt-20">{{ __('Viel Spass!') }}</p>
    </div>
    <x-buttons.primary 
      type="link"
      route="{{ localized_route('page.locations.list') }}"
      label="{!! __('Los geht\'s!') !!}">
    </x-buttons.primary>
  </div>
  <!-- End Success section -->
  @endsection
</x-layout.app>