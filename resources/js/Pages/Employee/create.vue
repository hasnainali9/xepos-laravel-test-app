<template>
    <div>
        <Head title="Create Company" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" href="/employees">Employees</Link>
            <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
                    <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last Name" />
                    <select-input v-model="form.company_id" :error="form.errors.company_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Owner">
                        <option :value="company.id" v-for="company in companies" :key="company.id">{{ company.name }}</option>
                    </select-input>
                    <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
                    <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
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
import SelectInput  from "../../Shared/SelectInput.vue";

export default {
    components: {
        FileInput,
        Head,
        Link,
        LoadingButton,
        TextInput,
        SelectInput,
    },
    layout: Layout,
    props: {
        companies: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                first_name: null,
                last_name: null,
                company_id: null,
                email:null,
                phone:null
            }),
        }
    },
    methods: {
        store() {
            this.form.post('/employees')
                // .then(() => {
                    // Log form errors
                    console.log(this.form);
                // })

        },
    },
}
</script>
