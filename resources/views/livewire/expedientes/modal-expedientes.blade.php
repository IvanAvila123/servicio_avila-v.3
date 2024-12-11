<div>
    <x-primary-button wire:click="openModal" class="ml-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Nuevo Expediente
    </x-primary-button>

    <x-modal name="crear-expediente" wire:model="modalVisible">
        <input type="hidden" wire:model="id_cliente">

        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">
                {{ $expediente_id ? 'Editar Expediente' : 'Crear Expediente' }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna Izquierda -->
                <div>
                    <!-- Equipo -->
                    <div class="mb-4">
                        <x-input-label for="equipo" value="Equipo" />
                        <x-text-input
                            wire:model="equipo"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Nombre del equipo"
                        />
                        <x-input-error :messages="$errors->get('equipo')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="problema" value="Problema" />
                        <x-text-input
                            wire:model="problema"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Problema Del Equipo"
                        />
                        <x-input-error :messages="$errors->get('equipo')" class="mt-2" />
                    </div>

                    <!-- Fecha -->
                    <div class="mb-4">
                        <x-input-label for="fecha" value="Fecha" />
                        <x-text-input
                            wire:model="fecha"
                            type="date"
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div>
                    <!-- Estado -->
                    <div class="mb-4">
                        <x-input-label for="estadoExpediente" value="Estado" />
                        <select
                            wire:model="estadoExpediente"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        >
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Completado">Completado</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                        <x-input-error :messages="$errors->get('estadoExpediente')" class="mt-2" />
                    </div>

                    <!-- Costo -->
                    <div class="mb-4">
                        <x-input-label for="costo" value="Costo" />
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <x-text-input
                                wire:model="costo"
                                type="number"
                                step="0.01"
                                class="block w-full pl-7"
                                placeholder="0.00"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('costo')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end gap-x-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-primary-button wire:click="save">
                    {{ $expediente_id ? 'Actualizar' : 'Crear' }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
