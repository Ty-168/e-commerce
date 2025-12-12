<script setup lang="ts">
import Navbar from './components/Navbar.vue';


</script>

<template>
  <Navbar/>
  <router-view></router-view>

</template>

<style>
/* FADE IN/OUT TRANSITION */

.fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  position: absolute; /* Ensures the element leaves without jumping the layout */
}

/* Styles for the element that is entering the list (fades in) */
.fade-enter-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
  transition-delay: 0.2s; /* Slight delay to make the fade in happen after elements start moving */
}

/* Initial state for entering and final state for leaving (opacity 0) */
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scale(0.9); /* Add a slight zoom effect */
}

/* Moving animation */
.fade-move {
  transition: transform 0.5s ease;
}
</style>


