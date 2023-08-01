<template>
    <main-layout>
        <div>Vue Index Page</div>
        <Link href="/hello">Show Page</Link>
        <div>The message is {{ message }}</div>
    </main-layout>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
defineProps({
    message: String,
});
</script>
