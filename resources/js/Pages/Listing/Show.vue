<template>
    <listing-address :listing="listing" />
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";

defineProps({
    listing: Object,
});
</script>

<style lang="scss" scoped></style>
