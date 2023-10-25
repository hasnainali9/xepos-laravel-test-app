<template>
    <div>
        <Head title="Companies" />
        <h1 class="mb-8 text-3xl font-bold">Companies</h1>
        <div class="flex items-center justify-between mb-6">
            <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset" />
            <Link class="btn-indigo" href="/companies/create">
                <span>Create</span>
                <span class="hidden md:inline">&nbsp;Company</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                <tr class="text-left font-bold">
                    <th class="pb-4 pt-6 px-6">Name</th>
                    <th class="pb-4 pt-6 px-6">Email</th>
                    <th class="pb-4 pt-6 px-6">Logo</th>
                    <th class="pb-4 pt-6 px-6" colspan="2">Website</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="company in companies.data" :key="company.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/companies/${company.id}/edit`">
                            {{ company.name }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/companies/${company.id}/edit`" tabindex="-1">
                            {{ company.email }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/companies/${company.id}/edit`" tabindex="-1">
                            <img v-if="company.logo" class="block -my-2 mr-2 w-14 h-14 rounded-full" :src="company.logo" />
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-6 py-4" :href="`/companies/${company.id}/edit`" tabindex="-1">
                            {{ company.website }}
                        </Link>
                    </td>
                    <td class="w-px border-t">
                        <Link class="flex items-center px-4" :href="`/companies/${company.id}/edit`" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="companies.data.length === 0">
                    <td class="px-6 py-4 border-t text-center" colspan="4">No Company found.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <pagination class="mt-6" :links="companies.links" />
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
        companies: Object,
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
                this.$inertia.get('/companies', pickBy(this.form), { preserveState: true })
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
