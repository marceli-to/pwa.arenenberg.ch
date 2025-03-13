<template>
  <button 
    :type="type" 
    :class="classes" 
    :disabled="disabled"
    :aria-label="label">
    {{ label }}
    <slot />
  </button>
</template>
<script setup>
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
    default: 'border border-pebble min-h-32 text-md text-graphite w-full flex items-center justify-center !ring-0 !outline-none hover:text-black transition-all hover:theme-color'
  },
  disabled: {
    type: Boolean,
    default: false
  },
  submitting: {
    type: Boolean,
    default: true
  }
});
</script>