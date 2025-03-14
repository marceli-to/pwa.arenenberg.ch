<template>
  <div class="flex flex-grow w-full overflow-hidden mt-48 relative">

    <Navigation>
      <template #title
        v-if="activeIndex > 0">
        <div class="absolute left-0 -top-60 w-full flex items-center justify-between bg-white dark:bg-black">
          <h1 class="opacity-20">
            {{ previousSectionName }}
          </h1>
          <a 
            href="javascript:;"
            @click.prevent="prev"
            title="Prev Section"
            class="opacity-20">
            <IconChevronLeft variant="small" />
          </a>
        </div>
      </template>
      <template #navigation>
        <ul>
          <li 
            v-for="(item, index) in slides" :key="index" 
            class="min-h-32 flex items-center border-b border-b-graphite first-of-type:border-t first-of-type:border-t-graphite mr-8">
            <a 
              href="javascript:;"
              @click="activeIndex = index"
              class="block w-full"
              :class="{ '': activeIndex === index }">
              {{ item.name }}
            </a>
          </li>
        </ul>
      </template>
    </Navigation>
    
    <div 
      class="flex flex-grow transition-transform duration-300 w-full relative z-40" 
      :style="{ transform: `translateX(-${computedOffsets[activeIndex]}%)` }">
      <section 
        v-for="(item, index) in slides" 
        :key="index" 
        :class="item.class"
        class="shrink-0">
        <h1 
          class="ml-8 opacity-1 flex justify-between items-center leading-none h-20"
          :class="{
            'transition-none delay-300': activeIndex === index, 
            'opacity-20': activeIndex !== index,
            'opacity-0 transition-all duration-none': activeIndex > index
          }">
          <span>{{ item.name }}</span>
          <template v-if="index >= activeIndex && index < slides.length - 1">
            <a 
              href="javascript:;"
              @click.prevent="next"
              title="Next Section"
              class="mr-8">
              <IconChevronRight variant="small" />
            </a>
          </template>
        </h1>
        <div class="flex flex-grow min-h-full pt-38">
          <div 
            class="flex-grow min-h-full border-r border-r-graphite relative"
            :class="{ 
              'opacity-20 pointer-events-none transition-all duration-none': activeIndex < index,
              'opacity-0 pointer-events-none transition-all duration-none': activeIndex > index
            }">
            <component v-if="item.component" :is="item.component" :isActive="activeIndex === index" />
            <slot v-else :name="`section-${index}`">
              No content provided for section {{ item.name }}
            </slot>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import IconChevronRight from '@/components/icons/ChevronRight.vue';
import IconChevronLeft from '@/components/icons/ChevronLeft.vue';
import Navigation from '@/components/slider/Navigation.vue';

const props = defineProps({
  slides: {
    type: Array,
    default: () => []
  },
  initialActiveIndex: {
    type: Number,
    default: 0
  }
});

const emit = defineEmits(['slide-change']);

const activeIndex = ref(props.initialActiveIndex);

watch(activeIndex, (newIndex) => {
  emit('slide-change', newIndex);
});

const computedOffsets = computed(() => {
  const offsets = [];
  let sum = 0;
  props.slides.forEach((slide) => {
    offsets.push(sum);
    sum += slide.width;
  });
  return offsets;
});

const previousSectionName = computed(() => {
  return activeIndex.value > 0 ? props.slides[activeIndex.value - 1].name : '';
});

function next() {
  if (activeIndex.value < props.slides.length - 1) {
    activeIndex.value++;
  }
}

function prev() {
  if (activeIndex.value > 0) {
    activeIndex.value--;
  }
}

defineExpose({
  activeIndex,
  next,
  prev
});
</script>