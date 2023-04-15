<script setup lang="ts">
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


interface user {
    id: number,
    name: string,
    email: string
}

defineProps<{
    users: user[]
}>()

const form = useForm({
        name: '',
        email: '',
        password: '',
        errors: {},
    })

function destroy(id: number) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('users.destroy', id));
    }
}
</script>
<template>
    <Head title="Users" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel 9 Vue JS CRUD App using Vite - Typescripts
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <Link
                                class="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                :href="route('users.create')"
                            >
                                Create user
                            </Link>
                        </div>
                        <table class="table-fixed w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-20">No.</th>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td class="border px-4 py-2">{{ user.id }}</td>
                                    <td class="border px-4 py-2">{{ user.name }}</td>
                                    <td class="border px-4 py-2">{{ user.email }}</td>
                                    <td class="border px-4 py-2">
                                        <Link
                                            tabIndex="1"
                                            class="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('users.edit', user.id)"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="destroy(user.id)"
                                            tabIndex="-1"
                                            type="button"
                                            class="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>