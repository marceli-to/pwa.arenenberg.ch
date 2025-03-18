@props(['src'])
<div 
  data-audio-player
  data-audio-src="/audio/{{ $src }}"
  class="text-sm">
  
  <!-- Buttons Row -->
  <div class="flex justify-around items-start">

    <!-- Rewind Button -->
    <div class="flex flex-col justify-center items-center">
      <span class="mb-5">−15</span>
      <button data-audio-rewind class="text-evergreen focus:outline-none">
        <x-audio.buttons.rewind />
      </button>
    </div>
    
    <!-- Play Button -->
    <div class="flex flex-col justify-end">
      <button data-audio-play class="text-evergreen focus:outline-none mt-16">
        <x-audio.buttons.play />
      </button>
    </div>
    
    <!-- Forward Button -->
    <div class="flex flex-col justify-center items-center">
      <span class="mb-5">+15</span>
      <button data-audio-forward class="text-evergreen focus:outline-none">
        <x-audio.buttons.forward />
      </button>
    </div>
  </div>
  
  <!-- Time & Progress Row -->
  <div class="mt-5">
    <!-- Time Left Display -->
    <div class="text-right">
      <span class="tabular-nums" data-audio-time-left>3:42</span>
    </div>
    
    <!-- Progress Bar Container -->
    <div data-audio-progress-container class="w-full bg-transparent border border-evergreen h-8 relative cursor-pointer">
      <div data-audio-progress class="bg-evergreen h-full" style="width: 0%"></div>
      <div data-audio-handle class="absolute hidden w-4 h-4 bg-white rounded-full top-0 -mt-0 -ml-2" style="left: 0%"></div>
    </div>
  </div>

</div>