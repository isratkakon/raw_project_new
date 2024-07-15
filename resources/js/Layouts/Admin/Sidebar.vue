
<script setup>
import { Link} from "@inertiajs/vue3";
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <aside class="fixed top-0 left-0 z-40 w-56 lg:w-64 h-screen pt-14 transition-transform -translate-x-full bg-teal-700 border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidenav" id="drawer-navigation">
        <div class="overflow-y-auto py-5 h-full bg-slate-300">
            <ul class="space-y-3 flex flex-col items-start justify-start ml-3 ">
                <li>
                    <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')"
                        class="flex w-[200px] text-[16px] py-2 items-start justify-start text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group" :class="{ 'active': route().current('admin.dashboard') }"> 
                        <span class="">
                            <i class="fa-solid fa-table-columns mr-2"></i>
                            Dashboard
                        </span>
                    </NavLink>
                </li>
                <!-- user  -->
                <!-- <li>
                    <NavLink :href="route('allusers')" :active="route().current('allusers')"
                        class="flex w-[200px] text-[16px] py-2 items-start justify-start text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group" :class="{ 'active': route().current('allusers') }"> 
                        <span class="">
                            <i class="fa-solid fa-users mr-2"></i>
                            Users
                        </span>
                    </NavLink>
                </li> -->
                


                <!-- <li>
                    <NavLink :href="route('admin.categories')" :active="route().current('admin.categories')"
                        class="flex w-[200px] text-[16px] py-2 items-start justify-start text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group" :class="{ 'active': route().current('admin.categories') }"> 
                        <span class="">
                            <i class="fa-solid fa-list mr-2 "></i>
                            Category
                        </span>
                    </NavLink>
                </li> -->

                <!-- <li>
                    <NavLink :href="route('admin.subcategories')" :active="route().current('admin.subcategories')"
                        class="flex w-[200px] text-[16px] py-2 items-start justify-start text-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group" :class="{ 'active': route().current('admin.subcategories') }"> 
                        <span class="">
                            <i class="fa-solid fa-list mr-2 "></i>
                           SubCategory
                        </span>
                    </NavLink>
                </li> -->
            </ul>
        </div>
    </aside>
</template>

<style scoped>
.active {
    background-color: rgb(139, 159, 167);
    border:none
}
</style>