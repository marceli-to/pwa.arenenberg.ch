<x-layout.app>
@section('content')
<div class="h-[calc(100dvh_-_165px)]">
  <figure class="h-[calc(100dvh_-_360px)] mt-25">
    <img src="/img/visual-home.png" alt="" width="698" height="956" class="w-full h-full object-contain">
  </figure>
  <div class="flex flex-col gap-y-25 h-155 mt-30">
    <div class="flex justify-center gap-45 max-w-[290px] mx-auto">
      <x-buttons.language route="{{ current_route('de') }}" label="D" active="{{ locale() === 'de' }}" />
      <x-buttons.language route="{{ current_route('fr') }}" label="F" active="{{ locale() === 'fr' }}" />
      <x-buttons.language route="{{ current_route('en') }}" label="E" active="{{ locale() === 'en' }}" />
    </div>
    <x-buttons.primary route="{{ localized_route('page.access') }}" label="{{ __('Start') }}" />
  </div>
</div>
@endsection
</x-layout.app>
