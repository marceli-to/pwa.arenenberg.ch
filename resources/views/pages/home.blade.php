<x-layout.app>
@section('content')
<div class="h-[calc(100dvh_-_165px)]">
  <figure class="h-[calc(100dvh_-_360px)] mt-10">
    <img src="/img/visual-home.png" alt="" width="698" height="956" class="w-full h-full object-contain">
  </figure>
  <div class="flex flex-col gap-y-40 h-155 mt-30">
    <div class="flex justify-center gap-45">
      <x-buttons.language route="{{ current_route('de') }}" label="D" active="{{ locale() === 'de' }}" />
      <x-buttons.language route="{{ current_route('fr') }}" label="F" active="{{ locale() === 'fr' }}" />
      <x-buttons.language route="{{ current_route('en') }}" label="E" active="{{ locale() === 'en' }}" />
    </div>
    <x-buttons.primary route="{{ current_route('de') }}" label="{{ __('Starten') }}" />
  </div>
</div>
@endsection
</x-layout.app>
