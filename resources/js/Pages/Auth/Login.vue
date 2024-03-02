<template >
    <div class="background-container">
        <Head title="Inicie sesion" />

        <GuestLayout>
        <Link href="/" class="flex items-center justify-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFF47l5UNGhkBR6ONfZH1RkuP6hYzG0x8w2g&usqp=CAU" alt="Logo de Google" class="h-20 w-20 rounded-full" />
        </Link>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="E-mail" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex justify-between">
                <label class="inline-flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="mx-2 text-sm text-gray-600">Remember me</span> </label>

                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 underline hover:text-gray-900">
                    Forgot your password?
                </Link>

                
            </div>

            <div class="mt-6">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
                <br><br>            
            </div>
            
        </form>
        <button   class=" w-full rounded-md bg-green-600 px-4 py-2 text-center text-sm text-white hover:bg-green-500">
                    <Link :href="route('register')" class="mt-4 ">
                    create account
                    </Link>
        </button>
    </GuestLayout>
    </div>
    
</template>

<style>
.background-container {
  background-image: url("https://www.uts.edu.co/sitio/wp-content/uploads/2021/08/MG_6737.jpg"); 
  background-size: cover;
  background-position: center;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>



<script setup>

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
