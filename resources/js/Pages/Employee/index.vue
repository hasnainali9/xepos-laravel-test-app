<template>
    <div>
        <Head title="Employees" />
        <h1 class="mb-8 text-3xl font-bold">Employees</h1>
        <div class="flex items-center justify-between mb-6">
            <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" />
            <Link class="btn-indigo" href="/employees/create">
                <span>Create</span>
                <span class="hidden md:inline">&nbsp;Employees</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">First Name</th>
                    <th class="pb-4 pt-6 px-6">Last Name</th>
                    <th class="pb-4 pt-6 px-6">Company</th>
                    <th class="pb-4 pt-6 px-6">Email</th>
                    <th class="pb-4 pt-6 px-6" colspan="2">Phone</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="employ in employees.data" :key="employ.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
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
                        <Link class="flex items-center px-6 py-4" :href="`/companies/${employ.company_id}/edit`" tabindex="-1">
                            {{ employ.company_name }}
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
                <tr v-if="employees.data.length === 0">
                    <td class="px-6 py-4 border-t text-center" colspan="4">No Employees found.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <pagination class="mt-6" :links="employees.links" />
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import pickBy from 'lodash/pickBy'
import Layout from '../../Shared/Layout.vue'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '../../Shared/Pagination.vue'
import SearchFilter from '../../Shared/SearchFilter.vue'

export default {
    components: {
        Head,
        Icon,
        Link,
        Pagination,
        SearchFilter,
    },
    layout: Layout,
    props: {
        filters: Object,
        employees: Object,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/employees', pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
}
</script>
