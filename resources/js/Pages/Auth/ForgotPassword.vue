<template>
    <div class="background-container">
        <Head title="Forgot Password" />

        <GuestLayout>
            <Link href="/" class="flex justify-center items-center mb-4">
                 <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFF47l5UNGhkBR6ONfZH1RkuP6hYzG0x8w2g&usqp=CAU" alt="Logo de Google" class="h-20 w-20 rounded-full" />
             </Link>

             <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                link that will allow you to choose a new one.
            </div>

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

             <form @submit.prevent="submit">
                 <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" type="email" class="block mt-1 w-full" v-model="form.email" required autofocus autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex justify-end items-center mt-4">
                    <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </PrimaryButton>

                    
                </div>
                
            </form>
            

            <a :href="route('login')" class="mt-4 text-sm text-gray-600 underline hover:text-gray-900 float-right font-semibold">Volver</a>
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
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
