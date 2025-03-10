<template>
  <template v-if="variant === 'square'">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" :class="class">
      <path d="M15 9.25H13.5V13.5H6.5V9.25H5V15H15V9.25Z" fill="currentColor"/>
      <path d="M0 0V19.9999H20V0H0ZM19.5 19.4999H0.5V0.5H19.5V19.4999Z" fill="currentColor"/>
      <path d="M9.375 12.001H10.625V8H12.5L10 5L7.5 8H9.375V12.001Z" fill="currentColor"/>
    </svg>
  </template>
</template>
<script setup>
const props = defineProps({
  variant: {
    type: String,
    default: 'square',
    validator: value => ['square'].includes(value)
  },
  class: {
    type: String,
    default: ''
  }
});
</script>