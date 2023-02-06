<template>
    <AdminLayout title="Department">
         <!-- Breadcrumb -->
         <nav class="flex justify-end px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Employee
                    </a>
                </li>
            </ol>
        </nav>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-6 lg:px-6">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <form @submit.prevent="updateEmployee" class="p-4">

                        <div>
                            <InputLabel for="firstName" value="First Name" />
                            <TextInput id="firstName" v-model="form.firstName" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.firstName" />
                        </div>
                        <div>
                            <InputLabel for="lastName" value="Last Name" />
                            <TextInput id="lastName" v-model="form.lastName" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.lastName" />
                        </div>
                        <div>
                            <InputLabel for="middleName" value="Middle Name" />
                            <TextInput id="middleName" v-model="form.middleName" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.middleName" />
                        </div>
                        <div>
                            <InputLabel for="address" value="Address" />
                            <TextInput id="address" v-model="form.address" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>
                        <div>
                                <InputLabel for="department_id" value="Department" />
                                <select v-model="form.department_id" id="department_id" name="department_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.department_id" />
                        </div>
                        <div>
                                <InputLabel for="country_id" value="Country" />
                                <select v-model="form.country_id" id="country_id" name="country_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.country_id" />
                        </div>
                        <div>
                                <InputLabel for="state_id" value="State" />
                                <select v-model="form.state_id" id="state_id" name="state_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.state_id" />
                        </div>
                        <div>
                            <InputLabel for="zipCode" value="Zip Code" />
                            <TextInput id="zipCode" v-model="form.zipCode" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.zipCode" />
                        </div>
                        <div>
                            <InputLabel for="birthDate" value="Birth Date" />
                            <TextInput id="birthDate" v-model="form.birthDate" type="date" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.birthDate" />
                        </div>
                        <div>
                            <InputLabel for="hiredDate" value="Hired Date" />
                            <TextInput id="hiredDate" v-model="form.hiredDate" type="date" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                 />
                            <InputError class="mt-2" :message="form.errors.hiredDate" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Save
                            </PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../Layouts/AdminLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    countries: Array,
    states: Array,
    departments: Array,
    employee: Object
});

const form = useForm({
    firstName: props.employee?.firstName,
    lastName: props.employee?.lastName,
    middleName: props.employee?.middleName,
    address: props.employee?.address,
    department_id: props.employee?.department_id,
    country_id: props.employee?.country_id,
    state_id: props.employee?.state_id,
    zipCode: props.employee?.zipCode,
    birthDate: props.employee?.birthDate,
    hiredDate: props.employee?.hiredDate
});

const updateEmployee = () => {
    Inertia.post(`/employees/${props.employee.id}`, {

        _method: "put",
        firstName: form.firstName,
        lastName: form.lastName,
        middleName: form.middleName,
        address: form.address,
        department_id: form.department_id,
        country_id: form.country_id,
        state_id: form.state_id,
        zipCode: form.zipCode,
        birthDate: form.birthDate,
        hiredDate: form.hiredDate,
    });
};
</script>
