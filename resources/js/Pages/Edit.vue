<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from 'axios'


const props = defineProps({
    auto: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    marca: props.auto.marca,
    modelo: props.auto.modelo,
    tipo: props.auto.tipo,
});


const submit = () => {
    form.put(route("auto.update", props.auto.id));
};

onMounted(() => {

});
</script>

<template>
    <Head title="Editar Auto" />

    <AuthenticatedLayout>
       <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Blog Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="marca" value="Marca" />

                                <TextInput
                                    id="marca"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.marca"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.marca"
                                />
                            </div>

                            <div class="my-6">
                                <InputLabel for="modelo" value="Modelo" />
                                <TextInput
                                    id="modelo"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.modelo"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.modelo"
                                />
                            </div>

                            <div class="my-6">
                                <InputLabel for="tipo" value="Tipo" />
                                <select
                                    id="tipo"
                                    name="tipo"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.tipo"
                                >
                                    <option value="camioneta">Camioneta</option>
                                    <option value="auto" selected>Auto</option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tipo"
                                />
                            </div>
                            <PrimaryButton
                                type="submit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Editar
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
