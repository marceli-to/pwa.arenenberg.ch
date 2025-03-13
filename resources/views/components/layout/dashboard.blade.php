<x-layout.dashboard.head />
<x-layout.dashboard.main>
  @auth
    <div>
      {{ $slot }}
    </div>
  @else
    @yield('content')
  @endauth
</x-layout.dashboard.main>
<x-layout.dashboard.footer />