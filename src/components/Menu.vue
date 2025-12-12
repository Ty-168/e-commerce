<script setup lang="ts">
const emit = defineEmits(['group-selected']);
const props = defineProps<{
    section: string
    menus: string[]
    selectedGroup: string
}>();

const selectGroup = (groupName: string) => {
  emit('group-selected', groupName);
}


</script>

<template>
  <div class="flex flex-row w-full text-sm justify-content-between items-center font-medium text-center text-body">
    <h5 class="w-1/3 text-start text-2xl font-quicksand font-bold">{{ props.section }}</h5>
    <ul class="w-full flex flex-wrap -mb-px justify-end items-end font-quicksand">
        <li class="me-2">
            <button 
                @click="selectGroup('All')"
                :class="{'text-primary border-primary': props.selectedGroup === 'All', 'hover:text-primary hover:border-primary': props.selectedGroup !== 'All'}"
                class="inline-block p-4 border-b border-transparent rounded-t-base"
            >All
          </button>
        </li>
        <li class="me-2" v-for="menu in props.menus">
            <button 
                @click="selectGroup(menu)"
                :class="{'text-primary border-primary': props.selectedGroup === menu, 'hover:text-primary hover:border-primary': props.selectedGroup !== menu}"
                class="inline-block p-4 border-b border-transparent rounded-t-base"
            >{{ menu }}
          </button>
        </li>
    </ul>
  </div>

</template>