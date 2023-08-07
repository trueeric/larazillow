<template>
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings </Link>
                </div>
                <div
                    class="text-lg text-indigo-700 dark:text-indigo-300 font-bold text-center"
                >
                    <Link :href="route('listing.index')">Larazillow</Link>
                </div>
                <div class="text">
                    <Link
                        :href="route('listing.create')"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md"
                        >+ New Listing</Link
                    >
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
        >
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

// USE page.props.flash.success!!   DO NOT page.props.value.flash.success
const page = usePage();
// console.log("kk1:", page);
// console.log('kk:',page.props.value.flash.success);

const flashSuccess = computed(() => page.props.flash.success);
// console.log("kk2:", flashSuccess);
</script>
