<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { home } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import Button from 'primevue/button';
import Carousel from 'primevue/carousel';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: home(),
    },
];

const images = [
    '/images/slideshow-character1.png',
    '/images/slideshow-character2.png',
    '/images/slideshow-character3.png',
];

const currentImageIndex = ref(0);
let intervalId: ReturnType<typeof setInterval>;

onMounted(() => {
    intervalId = setInterval(() => {
        currentImageIndex.value = (currentImageIndex.value + 1) % images.length;
    }, 5000);
});

onUnmounted(() => {
    clearInterval(intervalId);
});

const products = ref([
    {
        name: 'Bamboo Watch',
        image: 'bamboo-watch.jpg',
        price: 65,
        inventoryStatus: 'INSTOCK',
    },
    {
        name: 'Black Watch',
        image: 'black-watch.jpg',
        price: 72,
        inventoryStatus: 'INSTOCK',
    },
    {
        name: 'Blue Watch',
        image: 'bamboo-watch.jpg',
        price: 89,
        inventoryStatus: 'OUTOFSTOCK',
    },
    {
        name: 'Brown Watch',
        image: 'bamboo-watch.jpg',
        price: 165,
        inventoryStatus: 'INSTOCK',
    },
    {
        name: 'Green Watch',
        image: 'bamboo-watch.jpg',
        price: 72,
        inventoryStatus: 'OUTOFSTOCK',
    },
    {
        name: 'Grey Watch',
        image: 'bamboo-watch.jpg',
        price: 72,
        inventoryStatus: 'INSTOCK',
    },
    {
        name: 'White Watch',
        image: 'bamboo-watch.jpg',
        price: 165,
        inventoryStatus: 'INSTOCK',
    },
]);

const responsiveOptions = ref([
    {
        breakpoint: '1024px',
        numVisible: 5,
        numScroll: 2,
    },
    {
        breakpoint: '768px',
        numVisible: 3,
        numScroll: 1,
    },
    {
        breakpoint: '560px',
        numVisible: 1,
        numScroll: 1,
    },
]);

const getSeverity = (status: string) => {
    switch (status) {
        case 'INSTOCK':
            return 'success';
        case 'LOWSTOCK':
            return 'warning';
        case 'OUTOFSTOCK':
            return 'danger';
    }
};

const categories = ref([
    { name: 'T-Shirts', image: '/images/home/demo3/category_1.png' },
    { name: 'Jackets', image: '/images/home/demo3/category_2.png' },
    { name: 'Pants', image: '/images/home/demo3/category_3.png' },
    { name: 'Dresses', image: '/images/home/demo3/category_4.png' },
    { name: 'Accessories', image: '/images/home/demo3/category_5.png' },
    { name: 'Shoes', image: '/images/home/demo3/category_6.png' },
    { name: 'Bags', image: '/images/home/demo3/category_7.png' },
    { name: 'Jewelry', image: '/images/home/demo3/category_8.png' },
    { name: 'Beauty', image: '/images/home/demo3/category_9.jpg' },
    { name: 'Gifts', image: '/images/home/demo3/category_10.jpg' },
]);
</script>

<template>
    <Head title="Home" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Hero Section -->
        <section
            class="relative overflow-hidden bg-linear-to-br from-primary/10 to-secondary/10 py-20"
        >
            <div class="container mx-auto px-4">
                <div
                    class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2"
                >
                    <div>
                        <h1 class="inter mb-6 text-8xl font-bold">
                            Welcome to
                            <span class="text-yellow-500">Aesthetics</span>
                        </h1>
                        <p class="mb-8 text-xl">
                            A place where aesthetics meets endless loop of
                            collections.
                        </p>
                        <div class="flex gap-4">
                            <Button size="large">Shop Now</Button>
                            <Button variant="outlined" size="large"
                                >Learn More</Button
                            >
                        </div>
                    </div>
                    <!-- Image Section -->
                    <div
                        class="relative flex h-[500px] justify-center lg:justify-end"
                    >
                        <div class="relative h-full w-full max-w-lg">
                            <img
                                v-for="(img, index) in images"
                                :key="index"
                                :src="img"
                                alt="Hero Image"
                                class="absolute top-0 left-0 h-full w-full rounded-2xl object-contain transition-opacity duration-1000 ease-in-out"
                                :class="
                                    currentImageIndex === index
                                        ? 'opacity-100'
                                        : 'opacity-0'
                                "
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <p class="inter my-6 ml-6 text-center text-2xl font-bold">
                You Might Like
            </p>
            <Carousel
                :value="products"
                :numVisible="5"
                :numScroll="1"
                circular
                :responsiveOptions="responsiveOptions"
                :autoPlayInterval="5000"
            >
                <template #item="slotProps">
                    <div
                        class="border-surface-200 dark:border-surface-700 m-2 rounded border p-4"
                    >
                        <div class="mb-4">
                            <div class="relative mx-auto">
                                <img
                                    :src="
                                        'https://primefaces.org/cdn/primevue/images/product/' +
                                        slotProps.data.image
                                    "
                                    :alt="slotProps.data.name"
                                    class="w-full rounded"
                                />
                                <Tag
                                    :value="slotProps.data.inventoryStatus"
                                    :severity="
                                        getSeverity(
                                            slotProps.data.inventoryStatus,
                                        )
                                    "
                                    class="absolute"
                                    style="left: 5px; top: 5px"
                                />
                            </div>
                        </div>
                        <div class="mb-4 font-medium">
                            {{ slotProps.data.name }}
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="mt-0 text-xl font-semibold">
                                ${{ slotProps.data.price }}
                            </div>
                            <span>
                                <Button
                                    icon="pi pi-heart"
                                    severity="secondary"
                                    variant="outlined"
                                />
                                <Button
                                    icon="pi pi-shopping-cart"
                                    class="ml-2"
                                />
                            </span>
                        </div>
                    </div>
                </template>
            </Carousel>
        </section>
        <!-- Categories -->
        <section class="container mx-auto px-4 py-16">
            <h2
                class="inter mb-10 text-center text-3xl font-bold tracking-widest text-foreground uppercase"
            >
                Shop by<span class="ml-2 text-primary">Category</span>
            </h2>

            <div class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-5">
                <div
                    v-for="(category, index) in categories"
                    :key="index"
                    class="group flex cursor-pointer flex-col items-center"
                >
                    <div
                        class="relative h-32 w-32 overflow-hidden rounded-full border-2 border-transparent bg-muted shadow-sm transition-all duration-300 group-hover:border-primary group-hover:shadow-lg md:h-44 md:w-44"
                    >
                        <img
                            :src="category.image"
                            :alt="category.name"
                            class="h-full w-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110"
                        />
                        <!-- Luxury dark overlay effect on hover -->
                        <div
                            class="absolute inset-0 bg-black/0 transition-colors duration-300 group-hover:bg-black/10"
                        ></div>
                    </div>
                    <span
                        class="mt-4 text-lg font-semibold tracking-wide text-foreground uppercase transition-colors duration-300 group-hover:text-primary"
                    >
                        {{ category.name }}
                    </span>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
