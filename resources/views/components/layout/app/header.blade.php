<header class="sticky top-0 pt-20 w-full z-40 bg-blush">
  <div class="w-full flex justify-between">
    <div>
      <h1 class="text-crimson text-xl leading-none">
        {!! __('Kaiser, Kühe<br>und Kultur') !!}
      </h1>
      <div class="text-crimson">
        {!! __('Ein Parcours durch die<br>Arenenberger Vielfalt') !!}
      </div>
    </div>
    <div class="mt-10">
      <a 
        href="javascript:;"
        @click="menu = !menu"
        class="w-46 h-32 flex items-center justify-center">
        <span x-show="!menu">
          <x-icons.burger class="w-46 h-auto" />
        </span>
        <span x-show="menu">
          <x-icons.cross class="w-32 h-auto" />
        </span>
      </a>
    </div>
  </div>
</header>
<x-layout.app.menu.wrapper />