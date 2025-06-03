<x-layout.app>
@section('content')
<div>
  <figure class="mt-25">
    <img src="/img/visual-home.png" alt="" width="698" height="956" class="w-full h-auto pb-180">
  </figure>
  <div class="fixed bottom-25 left-1/2 -translate-x-1/2 flex flex-col gap-y-25 h-155 pt-25">
    <div class="flex justify-center gap-45 max-w-[290px] mx-auto">
      <x-buttons.language route="{{ current_route('de') }}" label="D" active="{{ locale() === 'de' }}" language="de" />
      <x-buttons.language route="{{ current_route('fr') }}" label="F" active="{{ locale() === 'fr' }}" language="fr" />
      <x-buttons.language route="{{ current_route('en') }}" label="E" active="{{ locale() === 'en' }}" language="en" />
    </div>
    <x-buttons.primary route="{{ localized_route('page.access') }}" label="{{ __('Start') }}" />
  </div>
</div>
@endsection
</x-layout.app>
