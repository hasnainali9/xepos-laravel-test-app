<template>
    <div>
        <Head title="Create Company" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" href="/companies">Companies</Link>
            <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
                    <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
                    <file-input v-model="form.logo" :error="form.errors.logo" class="pb-8 pr-6 w-full lg:w-1/2" label="Logo" />
                    <text-input v-model="form.website" :error="form.errors.website" class="pb-8 pr-6 w-full lg:w-1/2" label="Website" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Company</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '../../Shared/Layout.vue'
import TextInput from '../../Shared/TextInput.vue'
import LoadingButton from '../../Shared/LoadingButton.vue'
import FileInput from "../../Shared/FileInput.vue";

export default {
    components: {
        FileInput,
        Head,
        Link,
        LoadingButton,
        TextInput,
    },
    layout: Layout,
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                logo: null,
                website:null
            }),
        }
    },
    methods: {
        store() {
            this.form.post('/companies')
                // .then(() => {
                    // Log form errors
                    console.log(this.form);
                // })

        },
    },
}
</script>
