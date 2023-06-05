<script setup lang="ts">
import GuestLayout from "../../Layouts/GuestLayout.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import Checkbox from "../../Components/Checkbox.vue";
import OAuthLogin from "../../Components/OAuthLogin.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";


const form = new useForm({
    email: null,
    password: null,
    remember: false
})

const submit = () => {
    form.post('/login', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    });
};
</script>

<template>
    <GuestLayout>
        <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
            <header class="sm:mx-auto sm:w-full sm:max-w-md">
                <h1 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Log in to Squeaker!</h1>
            </header>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
                <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="email" value="Email address" />

                            <div class="mt-2">
                                <TextInput
                                    v-model="form.email"
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />

                                <InputError
                                    v-if="form.errors.email"
                                    class="block font-medium mt-2"
                                    :message="form.errors.email" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="password" value="Password" />

                            <div class="mt-2">
                                <TextInput
                                    v-model="form.password"
                                    id="password" name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />

                                <InputError :message="form.errors.password" class="block font-medium mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox v-model:checked="form.remember" name="remember-me"/>
                                <span class="ml-3 block text-sm leading-6 text-gray-900">Remember me</span>
                            </label>
                        </div>

                        <PrimaryButton class="flex w-full justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log In
                        </PrimaryButton>
                    </form>

                    <div>
                        <div class="relative mt-10">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-200" />
                            </div>
                            <div class="relative flex justify-center text-sm font-medium leading-6">
                                <span class="bg-white px-6 text-gray-900">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <OAuthLogin github-link="/login/github" google-link="/google/login" />
                        </div>
                    </div>
                </div>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Not a member?
                    {{ ' ' }}
                    <Link href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</Link>
                </p>
            </div>
        </div>
    </GuestLayout>
</template>
