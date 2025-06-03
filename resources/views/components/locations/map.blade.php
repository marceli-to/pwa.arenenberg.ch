<figure class="relative">
  <svg viewBox="0 0 1000 1400" class="block w-full h-auto pb-100 text-blush !leading-none relative">
    <image href="/img/map.png" width="1000" height="1400" preserveAspectRatio="xMidYMid slice" />

    <a 
      href="{{ localized_route('page.locations.show', Str::slug('Arenenberger Vielfalt')) }}"
      title="{{ __('Arenenberger Vielfalt') }}"
      class="block w-29 h-29 absolute text-crimson">
      <g transform="translate(375.5, 1060.5) scale(2.5)">
        @include('components.icons.numbers.red.1', ['class' => 'block w-29 h-29'])
      </g>
    </a>

    <a 
      href="{{ localized_route('page.locations.show', Str::slug('Milch mit Zukunft')) }}"
      title="{{ __('Milch mit Zukunft') }}"
      class="block w-29 h-29 absolute text-crimson">
      <g transform="translate(830, 520) scale(2.5)">
        @include('components.icons.numbers.red.2', ['class' => 'block w-29 h-29'])
      </g>
    </a>
    
    <a 
      href="{{ localized_route('page.locations.show', Str::slug('Vom Acker auf den Tisch')) }}"
      title="{{ __('Vom Acker auf den Tisch') }}"
      class="block w-29 h-29 absolute text-crimson">
      <g transform="translate(795, 100) scale(2.5)">
        @include('components.icons.numbers.red.3', ['class' => 'block w-29 h-29'])
      </g>
    </a>
    
    <a 
      href="{{ localized_route('page.locations.show', Str::slug('Wundervolle Gartenwelt')) }}"
      title="{{ __('Wundervolle Gartenwelt') }}"
      class="block w-29 h-29 absolute text-crimson">
      <g transform="translate(380, 760) scale(2.5)">
        @include('components.icons.numbers.red.4', ['class' => 'block w-29 h-29'])
      </g>
    </a>
    
    <a 
      href="{{ localized_route('page.locations.show', Str::slug('Kaiserliches Leben')) }}"
      title="{{ __('Kaiserliches Leben') }}"
      class="block w-29 h-29 absolute text-crimson">
      <g transform="translate(510, 1120) scale(2.5)">
        @include('components.icons.numbers.red.5', ['class' => 'block w-29 h-29'])
      </g>
    </a>
  
  </svg>
</figure>