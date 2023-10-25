<template>
    <div>
        <Head title="Dashboard" />
        <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
        <p class="mb-8 leading-normal">Hey there! This is Test Laravel App For XEPOS </p>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '../../Shared/Layout.vue'

export default {
    components: {
        Head,
    },
    layout: Layout,
}
</script>
