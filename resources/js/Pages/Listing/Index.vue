<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <!-- <Link :href="`/listing/${listing.id}`"> -->
                <Link :href="route('listing.show', listing.id)">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <listing-space :listing="listing" class="text-lg" />
                    <listing-address :listing="listing" class="text-gray-500" />
                </Link>
            </div>
            <div>
                <!-- <Link :href="`/listing/${listing.id}/edit`">Edit</Link>&nbsp; -->
                <Link :href="route('listing.edit', listing.id)">Edit</Link>
            </div>
            <div>
                <!-- <Link :href="`/listing/${listing.id}`" method="DELETE" as="button" >Delete</Link
            >-->
                <Link
                    :href="route('listing.destroy', listing.id)"
                    method="DELETE"
                    as="button"
                    >Delete</Link
                >
            </div>
        </Box>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";

defineProps({
    listings: Array,
});
</script>

<style lang="scss" scoped></style>
