<script setup lang="ts">
import AuthenticatedLayout from "../../../../Layouts/AuthenticatedLayout.vue";
import Editor from '@tinymce/tinymce-vue'
import {Link, useForm} from '@inertiajs/vue3'
import { User1 } from "../../../../types/User";
import { defineProps, ref } from "vue";

const props = defineProps<{
    user: User1
    countries: object
}>()

const form = useForm({
    user_id: props.user.data.id,
    name: props.user.data.name,
    description: props.user.data.information?.description ?? null,
    avatar: null,
    email: props.user.data.email,
    dob: props.user.data.information?.dob ?? null,
    country: props.user.data.information?.country?.name ?? null,
})

let avatar = ref<string>(props.user.data.avatar)
if (props.user.data.avatar.startsWith('avatar-')) {
    avatar.value = `/storage/avatars/${props.user.data.avatar}`
} else {
    avatar.value = props.user.data.avatar
}

const submit = () => {
    form.post('/user/settings/profile/update', form, {
        preserveScroll: true,
        preserveState: false,
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto bg-white px-10 py-5 my-10 sm:rounded-lg shadow">
            <form enctype="multipart/form-data" @submit.prevent="submit">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.name" type="text" name="username" id="username" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" :placeholder="user.data.name" />
                                    </div>

                                    <div v-if="form.errors.name">
                                        <p class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">About</label>
                                <div class="mt-2">
                                    <Editor
                                        v-model="form.description"
                                        api-key="no-api-key"
                                        :init="{
                                        toolbar: false,
                                        menubar: false,
                                        statusbar: false,
                                        }"
                                    />

                                    <div v-if="form.errors.description">
                                        <p class="mt-2 text-sm text-red-600">{{ form.errors.description }}</p>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself. <strong>Markdown is available!</strong></p>
                            </div>

                            <div class="col-span-full">
                                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <img :src="avatar" :alt="user.data.name" class="w-10 h-10 rounded-full" />
                                    <input type="file" @input="form.avatar = $event.target.files[0]" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                </div>
                                <div v-if="form.errors.avatar">
                                    <p class="mt-2 text-sm text-red-600">{{ form.errors.avatar }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" :placeholder="user.data.email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                    <div v-if="form.errors.email">
                                        <p class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sm-col-span-4 mt-2">
                                <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">Date of Birth:</label>
                                <input v-model="form.dob" type="date" id="dob" name="dob" pattern="\d{4}-\d{2}-\d{2}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <div v-if="form.errors.dob">
                                    <p class="mt-2 text-sm text-red-600">{{ form.errors.dob }}</p>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                <div class="mt-2">
                                    <select v-model="form.country" id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option v-for="country in props.countries" :key="country.id">{{ country.name }}</option>
                                    </select>

                                    <div v-if="form.errors.country">
                                        <p class="mt-2 text-sm text-red-600">{{ form.errors.country }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <Link :href="'/user/' + user.data.name" type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</Link>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
