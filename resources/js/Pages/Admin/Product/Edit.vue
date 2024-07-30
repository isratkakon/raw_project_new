<script setup>
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";

const props = defineProps({
    product: Object,
    categories:Array,
    subcategories:Array,
});

const form = useForm({
    category_id: props.product?.category_id,
    subcategory_id: props.product?.subcategory_id,
    product_name: props.product?.product_name,
    product_url: props.product?.product_url,
    product_details: props.product?.product_details,
    video: null,
    image: null,
});

const submit = () =>{
    router.post(`/admin/product/update/${props.product.id}`, {
        _method: "put",
        category_id: form.category_id,
        subcategory_id: form.subcategory_id,
        product_name: form.product_name,
        product_url: form.product_url,
        product_details: form.product_details,
        image: form.image,
        video: form.video,
    });
}
</script>

<template>
    <AdminLayout>
        <Head title="Product-Edit" />
        <h2 class="text-xl text-blue-700 leading-tight text-center">
           Edit Product Page
        </h2>

        <div class="w-full pb-5">
            <Link :href="route('admin.products')" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
            </Link>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="relative overflow-x-auto">

                <form @submit.prevent="submit" class="max-w-lg mx-auto">

                    <!-- product name  -->
                    <div class="mb-5">
                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" id="product_name" v-model="form.product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product name"/>
                        <div class="text-red-400 text-sm" v-if="errors && errors.product_name">{{ errors.product_name }}
                        </div>
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

                    <!-- subcategory_name -->
                    <div class="mb-5">
                        <label for="subcategory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SubCategory</label>
                        <select v-model="form.subcategory_id" id="subcategory_id" name="category_id" 
                            class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id" class="text-black"> {{ subcategory.subcategory_name }} </option>
                        </select>
                        <div class="text-red-400 text-sm" v-if="errors && errors.subcategory_id">{{ errors.subcategory_id }}</div>
                    </div>

                    

                    <!-- product details  -->
                    <div class="mb-5">
                        <label for="product_details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product details</label>
                        <input type="text" id="product_details" v-model="form.product_details" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product details"/>
                        <div class="text-red-400 text-sm" v-if="errors && errors.product_details">{{ errors.product_details }}
                        </div>
                    </div>

                    <!-- product url  -->
                    <div class="mb-5">
                        <label for="product_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product url</label>
                        <input type="text" id="product_url" v-model="form.product_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product url"/>
                        <div class="text-red-400 text-sm" v-if="errors && errors.product_url">{{ errors.product_url }}
                        </div>
                    </div>
                    
                    <!-- product image -->
                    <div class="mb-5">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Upload</label>
                        <input type="file" id="image" @input="form.image = $event.target.files[0]" class="bg-white-50 border border-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

                        <!-- show image -->
                        <div v-if="props.product.image" class="mt-2 mb-3">
                            <img :src="`/${props.product.image}`" alt=" Image" class="w-10 h-10 object-cover rounded-lg border border-gray-300" />
                        </div>
                    </div>
                    
                    <!-- video -->
                <div>
                    <label for="video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Product Video</label>
                    <input type="file" id="video" @change="e => form.video = e.target.files[0]" accept="video/mp4, video/webm"   class="bg-white-50 border border-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

                    <!-- show video -->
                    <div v-if="props.product.video" class="mt-2 mb-3">
                        <video class="h-40 w-40 object-cover rounded-sm border border-blue-300 p-2" controls>
                     <source :src="`/${product.video}`" type="video/mp4">
                       Your browser does not support the video tag.
                    </video>
                </div>
                   
                </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style>

</style>