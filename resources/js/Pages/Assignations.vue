<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const assignationsArray = ref([]);
const autosArray = ref([]);
const locationsArray = ref([]);

const getAssignations = async () => {
    let response = await axios.get(`/api/assignations`);
    assignationsArray.value = response.data;
};

const getAutos = async () => {
    let response = await axios.get(`/api/autos`);
    autosArray.value = response.data;
};

const getLocations = async () => {
    let response = await axios.get(`/api/locaciones`);
    locationsArray.value = response.data;
};

const form = useForm({
   auto_id: '',
   location_id: '',
});

const submit = () => {
    form.post(route("assignation.store",{
			preserveScroll: true,
			onSuccess: () => {
				reset('auto_id', 'location_id');
			}
		}));
};

onMounted(() => {
    getAssignations();
    getAutos();
    getLocations();
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Examen National
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-2 gap-4">
                            <div class="my-6">
                                <InputLabel for="auto_id" value="Auto" />
                                <select
                                    id="auto_id"
                                    name="auto_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.auto_id"
                                >
                                    <option
                                        v-for="auto in autosArray"
                                        :key="auto.id"
                                        :value="auto.id"
                                        selected
                                    >
                                        {{ auto.marca }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.auto_id"
                                />
                            </div>

                            <div class="my-6">
                                <InputLabel for="location_id" value="Locacion" />
                                <select
                                    id="location_id"
                                    name="location_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.location_id"
                                >
                                    <option
                                        v-for="location in locationsArray"
                                        :key="location.id"
                                        :value="location.id"
                                        selected
                                    >
                                        {{ location.nombre }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.location_id"
                                />
                            </div>
                            </div>
                            <PrimaryButton
                                type="submit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Asignar
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
