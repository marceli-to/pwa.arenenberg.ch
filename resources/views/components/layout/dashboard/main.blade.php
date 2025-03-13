<main 
  role="main"
  @class([
    'flex-1 flex justify-center items-center' => !Auth::check(),
    'mx-auto max-w-3xl w-full' => Auth::check(),
  ])>
  {{ $slot }}
</main>