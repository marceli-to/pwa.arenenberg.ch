@props([
  'title' => '',
  'contentClasses' => '',
  'id' => '',
])
<div 
	class="w-full border-t border-t-evergreen py-20">
	<div 
		@click="activeSection = (activeSection === '{{ $id }}') ? null : '{{ $id }}'"
		class="flex items-center justify-between cursor-pointer">
		<span class="text-xl select-none">
			{{ $title }}
		</span>
		<span x-show="activeSection !== '{{ $id }}'">
			<x-icons.chevron-left />
		</span>
		<span x-show="activeSection === '{{ $id }}'">
			<x-icons.chevron-down />
		</span>
	</div>
	<div 
		class="mt-25 {{ $contentClasses }}"
		x-show="activeSection === '{{ $id }}'">
		<div>
			{{ $slot }}
		</div>
	</div>
</div>