<template>
    <Box>
        <div>
            <!-- <Link :href="`/listing/${listing.id}`"> 使用ziggy前的寫法-->
            <Link :href="route('listing.show', listing.id)">
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" />pm
                    </div>
                </div>
                <listing-space :listing="listing" class="text-lg" />
                <listing-address :listing="listing" class="text-gray-500" />
            </Link>
        </div>
        <!-- <div> Edit, delete換到擁有者的相關頁面  RealtorListingController.vue -->

        <!-- <div> -->
        <!-- <Link :href="`/listing/${listing.id}/edit`">Edit</Link>&nbsp; 使用ziggy前的寫法--->
        <!-- <Link :href="route('listing.edit', listing.id)">Edit</Link>
        </div> -->
        <!-- <Link :href="`/listing/${listing.id}`" method="DELETE" as="button" >Delete</Link
            > 使用ziggy前的寫法--->
        <!-- <Link
                :href="route('listing.destroy', listing.id)"
                method="DELETE"
                as="button"
                >Delete</Link
            > -->
        <!-- </div> -->
    </Box>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";

const props = defineProps({ listing: Object });
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
