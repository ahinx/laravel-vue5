<script setup>
// Inertia composables
import { reactive } from 'vue'
import { usePage, router, Link } from '@inertiajs/vue3'

// Ambil data product yang dikirim controller di props
const page = usePage()
const product = page.props.product

// Inisialisasi form dengan data lama
const form = reactive({
  name: product.name,
  description: product.description,
  price: product.price,
  stock: product.stock,
})

// Fungsi submit form
const submitForm = () => {
  // Kirim data dengan method PUT ke route('products.update')
  router.put(route('products.update', product.id), form)
}
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    <form @submit.prevent="submitForm">
      <!-- Name -->
      <div class="mb-4">
        <label class="block mb-1">Name:</label>
        <input 
          v-model="form.name" 
          type="text" 
          class="border rounded px-2 py-1 w-full"
        />
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block mb-1">Description:</label>
        <textarea 
          v-model="form.description" 
          class="border rounded px-2 py-1 w-full"
        ></textarea>
      </div>

      <!-- Price -->
      <div class="mb-4">
        <label class="block mb-1">Price:</label>
        <input 
          v-model="form.price" 
          type="number" 
          class="border rounded px-2 py-1 w-full"
        />
      </div>

      <!-- Stock -->
      <div class="mb-4">
        <label class="block mb-1">Stock:</label>
        <input 
          v-model="form.stock" 
          type="number" 
          class="border rounded px-2 py-1 w-full"
        />
      </div>

      <!-- Tombol Update -->
      <button 
        type="submit" 
        class="bg-green-500 text-white px-4 py-2 rounded"
      >
        Update
      </button>

      <!-- Tombol Kembali ke Index -->
      <Link 
        :href="route('products.index')" 
        class="ml-2 px-4 py-2 bg-gray-500 text-white rounded"
      >
        Cancel
      </Link>
    </form>
  </div>
</template>
