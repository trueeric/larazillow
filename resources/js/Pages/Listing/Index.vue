<template>
    <div v-for="listing in listings" :key="listing.id">
        <span>
            <Link :href="`/listing/${listing.id}`">
                <listing-address :listing="listing" /> </Link
            >&nbsp;
        </span>
        <span>
            <Link :href="`/listing/${listing.id}/edit`">Edit</Link>&nbsp;
        </span>
        <span>
            <Link :href="`/listing/${listing.id}`" method="DELETE" as="button"
                >Delete</Link
            >
        </span>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";

defineProps({
    listings: Array,
});
</script>

<style lang="scss" scoped></style>
