<template>
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full"
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
                <div v-if="user" class="flex items-center gap-4">
                    <Link
                        :href="route('notification.index')"
                        class="text-gray-500 relative pr-2 py-2 text-lg"
                    >
                        🔔
                        <div
                            v-if="notificationCount"
                            class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center"
                        >
                            {{ notificationCount }}
                        </div>
                    </Link>

                    <Link
                        class="text-sm text-gray-500"
                        :href="route('realtor.listing.index')"
                        >{{ user.name }}</Link
                    >
                    <Link
                        :href="route('realtor.listing.create')"
                        class="btn-primary"
                        >+ New Listing</Link
                    >
                    <div>
                        <!-- * method 要換成 delete 預設是get  另外 要加 as="button" 以免噴錯-->
                        <Link
                            :href="route('logout')"
                            method="DELETE"
                            as="button"
                            >Logout</Link
                        >
                    </div>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Sign-in</Link>
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4 w-full">
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
// console.log("kk0:", page);
// console.log('kk:',page.props.value.flash.success);

const flashSuccess = computed(() => page.props.flash.success);
// console.log("kk1:", flashSuccess);

// * 在右上角放入已登入的帳號
const user = computed(() => page.props.user);

// 未讀通知次數 顯示的最大值不超過9次
const notificationCount = computed(() =>
    Math.min(page.props.user.notificationCount)
);
// console.log("kk2:", user);
</script>
