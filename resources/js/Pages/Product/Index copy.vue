


<script setup>

// Inertia composables
import { computed } from 'vue'
import { usePage, Link, router } from '@inertiajs/vue3'

// Dapatkan data 'products' dari props yang dikirim oleh controller
const page = usePage()
// computed() agar otomatis reaktif jika props berubah
const products = computed(() => page.props.products)

// Fungsi untuk melakukan aksi delete
const handleDelete = (id) => {
  // Konfirmasi terlebih dahulu
  if (!confirm('Are you sure want to delete this product?')) return

  // router.delete() -> method Inertia untuk mengirim DELETE request ke route
  router.delete(route('products.destroy', id))
}
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Product List (Inertia)</h1>

    <!-- Tombol Create New Product -->
    <Link 
      :href="route('products.create')" 
      class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded"
    >
      Create New Product
    </Link>

    <!-- Tabel Daftar Produk -->
    <table class="min-w-full bg-white mt-4 border">
      <thead>
        <tr>
          <th class="px-6 py-3 border-b-2">ID</th>
          <th class="px-6 py-3 border-b-2">Name</th>
          <th class="px-6 py-3 border-b-2">Price</th>
          <th class="px-6 py-3 border-b-2">Stock</th>
          <th class="px-6 py-3 border-b-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping data products -->
        <tr v-for="product in products" :key="product.id">
          <td class="px-6 py-4 border-b">{{ product.id }}</td>
          <td class="px-6 py-4 border-b">{{ product.name }}</td>
          <td class="px-6 py-4 border-b">{{ product.price }}</td>
          <td class="px-6 py-4 border-b">{{ product.stock }}</td>
          <td class="px-6 py-4 border-b">
            <!-- Tombol View Detail -->
            <Link
              :href="route('products.show', product.id)"
              class="text-blue-600 mr-2"
            >
              View
            </Link>

            <!-- Tombol Edit -->
            <Link
              :href="route('products.edit', product.id)"
              class="text-green-600 mr-2"
            >
              Edit
            </Link>

            <!-- Tombol Delete -->
            <button
              @click="handleDelete(product.id)"
              class="text-red-600"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
