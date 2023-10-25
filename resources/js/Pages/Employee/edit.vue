<template>
    <div>
        <Head :title="form.first_name" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" href="/employees">Employees</Link>
            <span class="text-indigo-400 font-medium">/</span>
            {{ form.first_name }}
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
                    <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
                    <select-input v-model="form.company_id" :error="form.errors.company_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Owner">
                        <option :value="company.id" v-for="company in companies" :key="company.id">{{ company.name }}</option>
                    </select-input>
                    <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
                    <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
                </div>
                <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Employee</button>
                    <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Employee</loading-button>
                </div>
            </form>
        </div>
        <h2 class="mt-12 text-2xl font-bold">Company</h2>
        <div class="mt-6 bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">Name</th>
                    <th class="pb-4 pt-6 px-6">Email</th>
                    <th class="pb-4 pt-6 px-6">Logo</th>
                    <th class="pb-4 pt-6 px-6" colspan="2">Website</th>
                </tr>
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/employees/${form.company.id}/edit`">
                            {{ form.company.name }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/employees/${form.company.id}/edit`" tabindex="-1">
                            {{ form.company.email }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/employees/${form.company.id}/edit`" tabindex="-1">
                            <img v-if="form.company.logo" class="block -my-2 mr-2 w-14 h-14 rounded-full" :src="form.company.logo" />
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/employees/${form.company.id}/edit`" tabindex="-1">
                            {{ form.company.website }}
                        </Link>
                    </td>
                    <td class="w-px border-t">
                        <Link class="flex items-center px-4" :href="`/employees/${form.company.id}/edit`" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="form.company.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No Company found.</td>
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
        employee: Object,
        companies: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                first_name: this.employee.first_name,
                last_name: this.employee.last_name,
                company_id: this.employee.company_id,
                company:this.employee.company,
                email:this.employee.email,
                phone: this.employee.phone
            }),
        }
    },
    methods: {
        update() {
            this.form.put(`/employees/${this.employee.id}`)
        },
        destroy() {
            if (confirm('Are you sure you want to delete this Employee?')) {
                this.$inertia.delete(`/employees/${this.employee.id}`)
            }
        }
    },
}
</script>
