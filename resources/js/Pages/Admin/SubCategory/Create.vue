<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue"

defineProps({
    errors: Object,
    categories: Array
});

const form = useForm({
    category_id:'',
    subcategory_name:'',
    image: null,
});

const submit = () =>{
    form.post(route('subcategory.store'));
}
</script>

<template>
    <AdminLayout>
        <Head title="subcategory-create" />
        <h2 class="text-xl text-blue-700 leading-tight text-center">
           Add Category Page
        </h2>

        <div class="w-full pb-5">
            <Link :href="route('admin.subcategories')" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
            </Link>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="relative overflow-x-auto">

                <form @submit.prevent="submit" class="max-w-lg mx-auto">
                    
                    <!-- subcategory name  -->
                    <div class="mb-5">
                        <label for="subcategory_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SubCategory name</label>
                        <input type="text" id="subcategory_name" v-model="form.subcategory_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write subcategory name"/>
                        <div class="text-red-400 text-sm" v-if="errors && errors.subcategory_name">{{ errors.subcategory_name }}</div>
                    </div>
                    <!-- category name -->
                    <div class="mb-5">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select v-model="form.category_id" id="category_id" name="category_id" 
                            class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="category in categories" :key="category.id" :value="category.id" class="text-black"> {{ category.category_name }} </option>
                        </select>
                        <div class="text-red-400 text-sm" v-if="errors && errors.category_id">{{ errors.category_id }}</div>
                    </div>

                   <!-- Image  -->
                    <div class="mb-5">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Upload</label>
                        <input type="file" id="image" @input="form.image = $event.target.files[0]" class="bg-white-50 border border-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style></style>