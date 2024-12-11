<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <!-- Header con información del cliente y botón volver -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                Expedientes de {{ $cliente->nombre }} {{ $cliente->apellido }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $cliente->email }} | {{ $cliente->telefono }}
                            </p>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Direccion</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $cliente->direccion }}
                            </p>
                        </div>
                        <x-secondary-button wire:navigate href="{{ route('clientes') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Volver
                        </x-secondary-button>
                    </div>
                </div>

                <!-- Controles de búsqueda y filtros -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between">
                        <div class="flex items-center gap-4">
                            <x-text-input wire:model.live="search" type="search" placeholder="Buscar expediente..."
                                class="w-80" />
                            <select wire:model.live="perPage" class="rounded-md shadow-sm dark:bg-gray-700">
                                <option value="10">10 por página</option>
                                <option value="25">25 por página</option>
                                <option value="50">50 por página</option>
                            </select>
                        </div>

                        <!-- Botón para crear nuevo expediente -->

                        <livewire:expedientes.modal-expedientes :clienteId="$cliente->id" />
                    </div>
                </div>

                <!-- Tabla de expedientes -->
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($expedientes as $expediente)
                            <a href="{{ route('expediente', ['hash' => $expediente->hash_id, 'cliente_id' => $cliente->id]) }}" wire:navigate
                                class="relative group overflow-hidden p-4 rounded-lg bg-gray-800 dark:bg-gray-700
                                      before:absolute
                                      before:inset-0
                                      before:bg-gray-700
                                      before:scale-y-[0.1]
                                      before:origin-bottom
                                      before:transition
                                      before:duration-300
                                      hover:before:scale-y-100
                                      text-left">
                                <div class="relative">
                                    <!-- Fecha y Estado -->
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="text-sm text-gray-400">
                                            {{ $expediente->fecha->format('d/m/Y') }}
                                        </span>
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $expediente->estadoExpediente === 'Pendiente' ? 'bg-yellow-900 text-yellow-200' : '' }}
                                            {{ $expediente->estadoExpediente === 'En Proceso' ? 'bg-blue-900 text-blue-200' : '' }}
                                            {{ $expediente->estadoExpediente === 'Cancelado' ? 'bg-red-900 text-red-200' : '' }}
                                            {{ $expediente->estadoExpediente === 'Completado' ? 'bg-green-900 text-green-200' : '' }}">
                                            {{ $expediente->estadoExpediente }}
                                        </span>
                                    </div>

                                    <!-- Información Principal -->
                                    <div class="space-y-2">
                                        <h3 class="text-lg font-medium text-white">
                                            {{ $expediente->equipo }}
                                        </h3>
                                        <p class="text-sm text-gray-300 line-clamp-2">
                                            {{ $expediente->problema }}
                                        </p>
                                        <p class="text-lg font-bold text-lime-500">
                                            ${{ $expediente->costo }}
                                        </p>

                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="py-12 text-center text-gray-500 col-span-full dark:text-gray-400">
                                No hay expedientes registrados
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
