<script setup>
// Import dari Inertia
import { computed } from 'vue'
import { usePage, Link, Head, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Ambil data Inertia
const page = usePage()

// 'products' adalah objek paginated. 
// Kita bisa ambil 'data' (array item) dan 'links' (array navigasi).
const paginated = computed(() => page.props.products)
const products = computed(() => paginated.value.data)    // data item
const links = computed(() => paginated.value.links)      // data link

// Fungsi hapus data
const handleDelete = (id) => {
  if (!confirm('Are you sure want to delete this product?')) return
  router.delete(route('products.destroy', id))
}
</script>

<template>
    <!-- Title di tab browser -->
    <Head title="Produk" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produk</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <!-- Tabel Daftar Produk -->
                    <table class="min-w-full bg-white border">
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
                                    <Link :href="route('products.show', product.id)" class="text-blue-600 mr-2">View</Link>

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

                    <!-- Navigasi Pagination -->
                    <div class="mt-4 flex space-x-2">
                        <!-- links adalah array, tiap item punya 'url', 'label', 'active' -->
                        <div 
                            v-for="link in links" 
                            :key="link.label"
                        >
                            <!-- Jika 'url' null, artinya link disabled -->
                            <Link 
                                v-if="link.url" 
                                :href="link.url"
                                class="px-2 py-1 border rounded"
                                :class="{ 'bg-gray-200 text-gray-800': link.active }"
                                v-html="link.label"
                            />
                            <!-- Link non-klik (misal "..." atau page disabled) -->
                            <span 
                                v-else
                                class="px-2 py-1 border rounded text-gray-500"
                                v-html="link.label"
                            ></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
