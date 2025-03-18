<x-layout.app>
  @section('content')

  <!-- Access form section -->
  <form 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen flex flex-col justify-between" 
    data-access-form>
    <div class="mt-10">
      <h2 class="text-lg">
        {{ __('Passcode:') }}
      </h2>
      <div class="flex justify-around gap-x-15 max-w-[270px] mx-auto mt-75">
        <div>
          <input 
            type="text" 
            maxlength="1" 
            pattern="[0-9]" 
            inputmode="numeric"
            min="0" 
            max="9" 
            required
            data-access-input
            class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-xl">
        </div>
        <div>
          <input 
            type="text" 
            maxlength="1" 
            pattern="[0-9]" 
            inputmode="numeric"
            min="0" 
            max="9" 
            required
            data-access-input
            class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-xl">
        </div>
        <div>
          <input 
            type="text" 
            maxlength="1" 
            pattern="[0-9]" 
            inputmode="numeric"
            min="0" 
            max="9" 
            required
            data-access-input
            class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-xl">
        </div>
        <div>
          <input 
            type="text" 
            maxlength="1" 
            pattern="[0-9]" 
            inputmode="numeric"
            min="0" 
            max="9" 
            required
            data-access-input
            class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-xl">
        </div>
      </div>
      <div data-data-access-error></div>
    </div>

    <x-buttons.primary 
      type="button"
      label="{{ __('Abschicken') }}">
    </x-buttons.primary>
  </form>
  <!-- End Access form section -->

  <!-- Resources loader section  -->
  <div 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen hidden flex-col justify-between"
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
          class="w-full">
        </progress>
        <div data-cache-progress></div>
      </div>
    </div>
  </div>
  <!-- End Resources loader section -->

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