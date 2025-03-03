<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const selectedRole = ref('user'); // Default role is 'user'

const form = useForm({
    role: 'user', // Default role
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    specialization: '', // Field for 'Formateur'
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// Function to switch roles
const selectRole = (role) => {
    selectedRole.value = role;
    form.role = role;
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <!-- Role Selection Buttons -->
        <div class="flex justify-center mb-6">
            <button
                @click="selectRole('user')"
                :class="{
                    'bg-blue-600 text-white': selectedRole === 'user',
                    'bg-gray-200 text-black': selectedRole !== 'user',
                }"
                class="px-4 py-2 rounded-md mx-2"
            >
                User
            </button>
            <button
                @click="selectRole('formateur')"
                :class="{
                    'bg-blue-600 text-white': selectedRole === 'formateur',
                    'bg-gray-200 text-black': selectedRole !== 'formateur',
                }"
                class="px-4 py-2 rounded-md mx-2"
            >
                Formateur
            </button>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <!-- Additional Field for 'Formateur' -->
            <div v-if="selectedRole === 'formateur'" class="mt-4">
                <InputLabel for="specialization" value="Specialization" />
                <TextInput
                    id="specialization"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.specialization"
                    required
                />
                <InputError class="mt-2" :message="form.errors.specialization" />
            </div>
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
