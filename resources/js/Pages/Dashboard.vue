<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const autosArray = ref([]);
const toSearch = ref("");

const getAutos = async () => {
    try {
        let response = await axios.get(`/api/autos`);
        autosArray.value = response.data;
    } catch (error) {
        console.error("Error fetching autos:", error);
    }
};

const form = useForm({});

const destroy = async (id) => {
    if (confirm("Quieres borrarlo?")) {
        form.delete(route("auto.destroy", id));
        getAutos();
    }
};

const filteredAutos = computed(() => {
    if (!toSearch.value.trim()) {
        return autosArray.value;
    }

    return autosArray.value.filter((auto) => {
        return auto.locations.some((location) => {
            return location.nombre
                .toLowerCase()
                .includes(toSearch.value.toLowerCase());
        });
    });
});

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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-2 gap-4">
                            <!-- boton agregar -->
                            <div class="mb-4">
                                <InputLabel
                                    for="toSearch"
                                    value="Buscar locación"
                                />

                                <TextInput
                                    id="toSearch"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="toSearch"
                                />
                            </div>
                            <!-- filtro -->
                            <div class="my-auto">
                                <PrimaryButton>Agregar Carro</PrimaryButton>
                            </div>
                        </div>
                        <!-- tabla -->
                        <div
                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                        >
                            <table
                                class="w-full divide-y divide-gray-200 text-gray-500 dark:text-gray-400"
                                v-if="filteredAutos.length"
                            >
                                <thead
                                    class="bg-gray-50 font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-md"
                                        >
                                            ID
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-md"
                                        >
                                            Marca
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-md"
                                        >
                                            Modelo
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-md"
                                        >
                                            Tipo
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-md"
                                        >
                                            Locaciones
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-md"
                                        >
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        class="text-md text-gray-700 whitespace-nowrap"
                                        v-for="(item, index) in filteredAutos"
                                        :key="index"
                                    >
                                        <td class="px-6 py-4 whitespace-normal">
                                            {{ item.id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            {{ item.marca }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            {{ item.modelo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            {{ item.tipo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-normal">
                                            {{
                                                item.locations
                                                    .map(
                                                        (local) => local.nombre
                                                    )
                                                    .join(", ")
                                            }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <Link
                                                :href="
                                                    route('auto.edit', item.id)
                                                "
                                                class="px-4 py-2 text-white bg-blue-600 rounded-lg"
                                                >Editar</Link
                                            >
                                            <PrimaryButton
                                                class="mx-2 bg-red-700"
                                                @click="destroy(item.id)"
                                            >
                                                Delete
                                            </PrimaryButton>
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
        </div>
    </AuthenticatedLayout>
</template>
