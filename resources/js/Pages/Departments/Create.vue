<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head,useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    count: 1 
});

</script>

<template>
    <Head title="Agregar recurso" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Agregar Recurso</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="form.post(route('departments.store'))" class="mt-6 space-y-6 max-w-xl">
                        <InputLabel for="name" value="Recurso"></InputLabel>
                        <TextInput id="name" v-model="form.name" autofocus required type="text" class="mt-1 block w-full" autocomplete="off" list="departmentNames"></TextInput>
                        <datalist id="departmentNames">
                            <option value="Video Bean"></option>
                            <option value="Cable HDMI"></option>
                            <option value="Cable Vga"></option>
                        </datalist>
                        <InputError :message="form.errors.name" class="mt-2"></InputError>
    
                        <!-- Campo de entrada para la cantidad -->
                        <InputLabel for="count" value="Cantidad"></InputLabel>
                        <TextInput id="count" v-model="form.count" autofocus required type="number" class="mt-1 block w-full"></TextInput>
                        <InputError :message="form.errors.count" class="mt-2"></InputError>

                        <PrimaryButton :disabled="form.processing">
                            <i class="fa-solid fa-save"></i> Save
                        </PrimaryButton>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
