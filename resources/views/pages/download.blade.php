<x-layout.app>
  @section('content')
  <!-- Resources loader section  -->
  <div 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen flex flex-col justify-between"
    data-resources-loader>
    <div class="mt-10 pb-40 border-b border-b-evergreen">
      <h2 class="text-lg leading-[1.4]">
        {{ __('Die Inhalte werden heruntergeladen. Dies kann einen Moment dauern.') }}
      </h2>
      <div 
        class="mt-30"
        data-cache-status>
        <progress 
          data-cache-progress-bar 
          value="0" 
          max="100"
          class="w-full h-8 border border-evergreen bg-transparent appearance-none [&::-webkit-progress-bar]:border [&::-webkit-progress-bar]:border-evergreen [&::-webkit-progress-bar]:bg-transparent [&::-webkit-progress-value]:bg-evergreen [&::-moz-progress-bar]:bg-evergreen">
        </progress>
        <div data-cache-progress class="text-right"></div>
      </div>
    </div>
  </div>
  <!-- End Resources loader section -->

  <!-- Success section -->
  <div 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen hidden flex-col justify-between"
    data-success-section>
    <div class="text-xl py-10">
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