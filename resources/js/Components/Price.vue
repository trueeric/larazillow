<template>
    <span>{{ formattedPrice }}</span>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    price: [Number, String],
});
const formattedPrice = computed(() =>
    Number(props.price).toLocaleString("zh-TW", {
        style: "currency",
        currency: "TWD",
        maximumFractionDigits: 0,
    })
);
</script>
