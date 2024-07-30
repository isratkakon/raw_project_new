
<script setup>
 import { onMounted } from 'vue'
 import { initFlowbite } from 'flowbite';
 import Navbar from './Navbar.vue'; 
 import Footer from './Footer.vue'; 
 import Hero from './Hero.vue'; 
 

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

// product list

</script>

<template>
  
<!-- header -->
<Navbar></Navbar>

<!-- end -->

<!-- main content -->

<!-- hero section -->
<Hero></Hero>
<!-- end -->

<slot/>




<!-- end -->

<!-- footer -->

<Footer></Footer>


<!-- end -->

</template>


<style>

</style>