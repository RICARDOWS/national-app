<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    auto: {
        type: Object,
        default: () => ({}),
    },
});

const tiposArray = ref(["camioneta", "auto"]);

const form = useForm({
    marca: "",
    modelo: "",
    tipo: "",
});

const submit = () => {
    form.post(route("auto.store"));
};

onMounted(() => {});
</script>

<template>
    <Head title="Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear auto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto p-6">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4"
                >
                    <div
                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                    >
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
                                <TextInput
                                    id="tipo"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tipo"
                                    required
                                    autofocus
                                />

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
                                Crear
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
