<div 
  x-data="{ activeSection: null }" 
  class="{{ $class ?? '' }} border-b border-b-evergreen pb-25">
	{{ $slot }}
</div>