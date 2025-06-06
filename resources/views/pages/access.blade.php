<x-layout.app>
  @section('content')
  <form 
    class="w-full min-h-[calc(100dvh_-_175px)] mt-50 border-t border-t-evergreen flex flex-col justify-between" 
    data-access-form>
    <div class="mt-10">
      <div class="pb-60 border-b border-b-evergreen">
        <h2 class="text-lg">
          {{ __('Code:') }}
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
              class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-3xl">
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
              class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-3xl">
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
              class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-3xl">
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
              class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-3xl">
          </div>
        </div>
      </div>
      <div data-access-error class="text-crimson text-center mt-10 hidden">
        {{ __('ungültiger Code') }}
      </div>
    </div>

    <div class="fixed bottom-25 w-full left-1/2 -translate-x-1/2">
      <x-buttons.primary 
        route="{{ localized_route('page.download') }}"
        data-access-button
        type="link"
        label="{{ __('Abschicken') }}">
      </x-buttons.primary>
    </div>
  </form>
  @endsection
</x-layout.app>