<template>
  <button 
    :type="type" 
    :class="classes" 
    :disabled="disabled"
    :aria-label="label">
    <IconChevronRight variant="small" />
    {{ label }}
  </button>
</template>
<script setup>
import IconChevronRight from '@/components/icons/ChevronRight.vue';

const props = defineProps({
  type: {
    type: String,
    default: 'submit'
  },
  label: {
    type: String,
    required: true
  },
  classes: {
    type: String,
    default: 'border border-graphite min-h-32 text-md text-white w-full flex items-center justify-start gap-x-12 px-8 bg-pebble hover:theme-color hover:text-black !ring-0 !outline-none transition-all'
  },
  disabled: {
    type: Boolean,
    default: false
  }
});
</script>