<x-layout.app>
  @section('content')
  <!-- Resources loader section  -->
  <div 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen flex flex-col justify-between"
    data-resources-loader>
    <div class="mt-10 pb-40 border-b border-b-evergreen">
      <h2 class="text-lg leading-[1.4]">
        {{ __('Die Inhalte werden geladen. Dies dauert einen Moment.') }}
      </h2>
      <div 
        class="mt-30"
        data-cache-status>
        <progress 
          data-cache-progress-bar 
          value="0" 
          max="100"
          class="w-full h-8 border rounded-full border-evergreen bg-transparent appearance-none [&::-webkit-progress-bar]:rounded-full [&::-webkit-progress-bar]:border [&::-webkit-progress-bar]:border-evergreen [&::-webkit-progress-bar]:bg-transparent [&::-webkit-progress-value]:bg-evergreen [&::-moz-progress-bar]:bg-evergreen">
        </progress>
        <div data-cache-progress class="text-right"></div>
      </div>
    </div>
  </div>
  <!-- End Resources loader section -->

  <!-- Success section -->
  <div 
    class="w-full h-[calc(100dvh_-_175px)] mt-50 border-t border-t-evergreen hidden flex-col justify-between"
    data-success-section>
    <div class="text-lg py-10">
      <h1 class="text-2xl mb-15">{{ __('Erkunden Sie den Arenenberg!') }}</h1>
      <p>{{ __('Ein Kurzfilm und vier Hörreportagen mit Annette Fetscherin und Arenenberger Expertinnen und Experten gewähren Einblicke in die vielfältige Geschichte und Gegenwart des Ortes. Die Stationen auf dem gesamten Areal sind in beliebiger Reihenfolge erlebbar. Und stets erwartet Gross und Klein ein Spiel. Bei Fragen melden Sie sich gerne im Shop.') }}</p>
    </div>
    <x-buttons.primary 
      type="link"
      route="{{ localized_route('page.locations.list') }}"
      label="{!! __('Los geht’s!') !!}">
    </x-buttons.primary>
  </div>
  <!-- End Success section -->
  @endsection
</x-layout.app>