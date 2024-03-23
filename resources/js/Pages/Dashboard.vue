<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from 'axios'
import PrimaryButton from '@/Components/PrimaryButton.vue';

const autosArray = ref([]);

const getAutos = async () => {
        let response = await axios.get(`/api/autos`)
        autosArray.value = response.data
    }

onMounted(() => {
   getAutos();
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
            <div class="max-w-7xl mx-auto p-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex flex-col lg:flex-row justify-between py-4 px-8">
                    <h1 class="text-purple font-semibold text-2xl tracking-widest uppercase">
                        Autos
                    </h1>
                    <div class="flex flex-col lg:flex-row relative gap-2">
                        Busqueda
                    </div>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" v-if="autosArray.length">
                            <thead class="bg-gray-50 font-medium text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-md">
                                ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-md">
                                Marca
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-md">
                                Modelo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-md">
                                Tipo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-md">
                                Acciones
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                class="text-md text-gray-700 whitespace-nowrap"
                                v-for="(item,index) in autosArray"
                                :key="index"
                            >
                                <td class="px-6 py-4 whitespace-normal">{{ item.id  }}</td>
                                <td class="px-6 py-4 whitespace-normal">{{ item.marca }}</td>
                                <td class="px-6 py-4 whitespace-normal">{{ item.modelo }}</td>
                                <td class="px-6 py-4 whitespace-normal">{{ item.tipo }}</td>
                                <td class="px-6 py-4 whitespace-normal">
                                    <div class="flex">
                                        <PrimaryButton class="ms-4 bg-green-500">
                                            Ver
                                        </PrimaryButton>
                                        <PrimaryButton class="ms-4 bg-yellow-600">
                                            Editar
                                        </PrimaryButton>
                                        <PrimaryButton class="ms-4 bg-red-600">
                                            Borrar
                                        </PrimaryButton>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-else class="text-center py-3">
                            <div class="flex justify-center">
                            <p class="flex">No hay datos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
