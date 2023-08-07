<template>
    <Link href="/">Main Page </Link>&nbsp
    <Link href="/hello">Show Page</Link>
    <!-- <div>The page with time {{ timer }}</div> -->
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <div>{{ y }}</div>
    <slot>Default</slot>
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

// import { ref } from "vue";

// const timer = ref(0);
// setInterval(() => timer.value++, 1000);
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>
