<script setup>
import { Link, router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";

defineProps({   
  products : Object 
});

const deleteProduct = (id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(route('product.delete', id), {
        onFinish: () => {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
    }
  });
}

</script>

<template>
  <AdminLayout>
    <Head title="Product" />
    <h2 class="text-xl text-blue-700 leading-tight text-center">Products Home Page</h2>

    <div class="w-full pb-5">
      <Link :href="route('product.create')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Add Product
      </Link>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <div class="relative overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-blue-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Serial</th>
                <th scope="col" class="px-6 py-3">Category Name</th>
                <th scope="col" class="px-6 py-3">Subcategory Name</th>
                <th scope="col" class="px-6 py-3">Product Name</th>
                <th scope="col" class="px-6 py-3">Product Details</th>
                <th scope="col" class="px-6 py-3">Product Url</th>
                <th scope="col" class="px-6 py-3">Product Image</th>
                <th scope="col" class="px-6 py-3">Product Video</th>
                <th scope="col" class="px-6 py-3">Edit</th>
                <th scope="col" class="px-6 py-3">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in products" :key="product.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> {{ product.id }} </th>
                <td class="px-2 py-1"> {{ product.category ? product.category.category_name : 'N/A' }}</td>
                <td class="px-2 py-1"> {{ product.subcategory ? product.subcategory.subcategory_name : 'N/A' }}</td>
                <td class="px-2 py-1"> {{ product.product_name }}</td>
                <td class="px-2 py-1"> {{ product.product_details }}</td>
                <td class="px-2 py-1"> {{ product.product_url }}</td>
                <td class="px-2 py-1">
                  <img :src="`/${product.image}`" :alt="product.product_name" class="h-12 w-12 object-cover rounded-full border border-blue-300 p-2"/>
                </td>
                <td class="px-2 py-1">
                  <video class="h-20 w-20 object-cover rounded-sm border border-blue-300 p-2" controls>
                    <source :src="`/${product.video}`" type="video/mp4">
                  </video>
                </td>
                 
                 <td class="px-6 py-4">
                  <Link :href="route('product.edit', product.id)" class="font-medium text-green-600 dark:text-green-700 hover:underline">Edit</Link>
                </td>

                <td class="px-6 py-4">
                  <button @click="deleteProduct(product.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
               </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px pt-5" aria-label="Pagination">
          <button v-for="link in subcategories.links" :key="link.url || link.label"
            @click.prevent="updatePageNumber(link)"
            :disabled="link.active || !link.url"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
            :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
              'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active}">
            <span v-html="link.label"></span>
          </button>
        </nav> -->
      </div>
    </div>
  </AdminLayout>
</template>

<style></style>