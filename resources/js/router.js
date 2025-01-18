// resources/js/router.js

import { createRouter, createWebHistory } from "vue-router";
import Home from "@/Pages/Home.vue";
import IndexProduct from "@/Pages/Product/Index.vue";
import CreateProduct from "@/Pages/Product/Create.vue";
import EditProduct from "@/Pages/Product/Edit.vue";
import ShowProduct from "@/Pages/Product/Show.vue";

const routes = [
    { path: "/", name: "home", component: Home },
    {
        path: "/products",
        name: "product.index",
        component: IndexProduct,
    },
    {
        path: "/products/create",
        name: "product.create",
        component: CreateProduct,
    },
    {
        path: "/products/:id/edit",
        name: "product.edit",
        component: EditProduct,
        props: true,
    },
    {
        path: "/products/:id",
        name: "product.show",
        component: ShowProduct,
        props: true,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
