<x-layout.app.head />
<x-layout.app.header />
<x-layout.app.main class="{{ $class ?? '' }}">
  @yield('content')
</x-layout.app.main>
<x-layout.app.footer />