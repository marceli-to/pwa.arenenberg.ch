<x-layout.app>
  @section('content')
  <form 
    class="w-full h-[calc(100dvh_-_215px)] mt-50 border-t border-t-evergreen flex flex-col justify-between" 
    data-passcode>
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
            data-digit
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
            data-digit
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
            data-digit
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
            data-digit
            class="w-60 text-center bg-transparent border-0 border-b border-evergreen focus:outline-none focus:ring-0 focus:border-evergreen py-3 px-5 text-xl">
        </div>
      </div>
    </div>
    <a href="{{ localized_route('page.locations.list') }}">
      {{ __('Liste') }}
    </a>
    <x-buttons.primary 
      class=""
      type="button"
      label="{{ __('Abschicken') }}">
    </x-buttons.primary>
  </form>
  @endsection
</x-layout.app>