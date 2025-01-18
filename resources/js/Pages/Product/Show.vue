<script setup>
// Inertia composables
import { usePage, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


// Ambil data product dari props
const page = usePage()
const product = page.props.product
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Detail Product</h1>
    <div class="mb-4"><strong>Name:</strong> {{ product.name }}</div>
    <div class="mb-4"><strong>Description:</strong> {{ product.description }}</div>
    <div class="mb-4"><strong>Price:</strong> {{ product.price }}</div>
    <div class="mb-4"><strong>Stock:</strong> {{ product.stock }}</div>

    <!-- Tombol Kembali ke Index -->
    <Link 
      :href="route('products.index')" 
      class="px-4 py-2 bg-gray-500 text-white rounded"
    >
      Back
    </Link>
  </div>
</template>
