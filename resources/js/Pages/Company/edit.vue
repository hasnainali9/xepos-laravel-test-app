<template>
    <div>
        <Head :title="form.name" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" href="/companies">Companies</Link>
            <span class="text-indigo-400 font-medium">/</span>
            {{ form.name }}
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
                    <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
                    <file-input v-model="form.logo" :error="form.errors.logo" class="pb-8 pr-6 w-full lg:w-1/2" label="Logo" />
                    <img class="block -my-2 mr-2 w-14 h-14" :src="this.form.logoPreview" />
                    <text-input v-model="form.website" :error="form.errors.website" class="pb-8 pr-6 w-full lg:w-1/2" label="Website" />
                </div>
                <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Company</button>
                    <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Company</loading-button>
                </div>
            </form>
        </div>
        <h2 class="mt-12 text-2xl font-bold">Employees</h2>
        <div class="mt-6 bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">First Name</th>
                    <th class="pb-4 pt-6 px-6">Last Name</th>
                    <th class="pb-4 pt-6 px-6">Email</th>
                    <th class="pb-4 pt-6 px-6" colspan="2">Phone</th>
                </tr>
                <tr v-for="employ in company.employees" :key="employ.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/employees/${employ.id}/edit`">
                            {{ employ.first_name }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/employees/${employ.id}/edit`" tabindex="-1">
                            {{ employ.last_name }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/employees/${employ.id}/edit`" tabindex="-1">
                            {{ employ.email }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/employees/${employ.id}/edit`" tabindex="-1">
                            {{ employ.phone }}
                        </Link>
                    </td>
                    <td class="w-px border-t">
                        <Link class="flex items-center px-4" :href="`/employees/${employ.id}/edit`" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="company.employees.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No Employee found.</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import Layout from '../../Shared/Layout.vue'
import TextInput from '../../Shared/TextInput.vue'
import SelectInput from '../../Shared/SelectInput.vue'
import LoadingButton from '../../Shared/LoadingButton.vue'
import FileInput from "@/Shared/FileInput.vue";

export default {
    components: {
        FileInput,
        Head,
        Icon,
        Link,
        LoadingButton,
        SelectInput,
        TextInput
    },
    layout: Layout,
    props: {
        company: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                name: this.company.name,
                email: this.company.email,
                logo: null,
                logoPreview:this.company.logo,
                website: this.company.website
            }),
        }
    },
    methods: {
        update() {
            this.form.put(`/companies/${this.company.id}`)
        },
        destroy() {
            if (confirm('Are you sure you want to delete this Company?')) {
                this.$inertia.delete(`/companies/${this.company.id}`)
            }
        }
    },
}
</script>
