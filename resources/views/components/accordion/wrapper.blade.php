<div 
  x-data="{ activeSection: null }" 
  class="{{ $class ?? '' }} border-b border-b-evergreen">
	{{ $slot }}
</div>