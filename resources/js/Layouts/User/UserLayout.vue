<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';
onMounted(() => {
    initFlowbite();
})

const showingNavigationDropdown = ref(false);

// const props = defineProps({
//     user: Object,
// });

</script>

<template>
        
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <Navbar/>

            <Sidebar />
            <!-- Page Content -->
            <main class="p-4 md:ml-64 h-auto pt-20">
            <!-- <div v-if="$page.props.flash.message" class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 dark:bg-blue-100 alert" role="alert">
             <div class="max-w-7xl mx-auto">{{ $page.props.flash.message }}</div>
              </div> -->
           <slot/>

         </main>
       
      
    </div>
</template>