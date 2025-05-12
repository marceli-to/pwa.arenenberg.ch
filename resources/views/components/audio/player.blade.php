@props(['src'])
<div 
  data-audio-player
  data-audio-src="/audio/{{ $src }}"
  class="mt-10">
  
  <!-- Buttons Row -->
  <div class="flex justify-between items-center">

    <!-- Rewind Button -->
    <div class="flex justify-center items-center">
      <span class="mr-5">−15</span>
      <button data-audio-rewind class="text-evergreen focus:outline-none">
        <x-audio.buttons.rewind class="w-42 h-auto" />
      </button>
    </div>
    
    <!-- Play/Pause Buttons -->
    <div class="flex flex-col justify-end items-center">
      <button data-audio-play class="text-evergreen focus:outline-none">
        <x-audio.buttons.play class="w-30 h-auto" />
      </button>
      <button data-audio-pause class="text-evergreen focus:outline-none hidden -ml-8">
        <x-audio.buttons.pause class="w-30 h-auto" />
      </button>
    </div>
    
    <!-- Forward Button -->
    <div class="flex justify-center items-center">
      <button data-audio-forward class="text-evergreen focus:outline-none">
        <x-audio.buttons.forward class="w-42 h-auto" />
      </button>
      <span class="ml-5">+15</span>
    </div>
  </div>
  
  <!-- Time & Progress Row -->
  <div class="mt-20">
    
    <!-- Progress Bar Container -->
    <div data-audio-progress-container class="w-full bg-transparent rounded-full border border-evergreen h-8 relative cursor-pointer">
      <div data-audio-progress class="bg-evergreen h-full" style="width: 0%"></div>
      <div data-audio-handle class="absolute hidden w-4 h-4 bg-white rounded-full top-0 -mt-0 -ml-2" style="left: 0%"></div>
    </div>

    <div class="mt-5 flex justify-between">

      <!-- Time Total Display -->
      <span class="tabular-nums" data-audio-time-total>3:42</span>

      <!-- Time Remaining Display -->
      <span class="tabular-nums" data-audio-time-remaining>3:42</span>
    </div>

  </div>

</div>