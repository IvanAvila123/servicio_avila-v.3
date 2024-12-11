<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                        </h2>

                        <p class="text-gray-600 dark:text-gray-400">Fecha de creacion:
                            {{ $expediente->fecha->format('d/m/Y') }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-gray-600 dark:text-gray-400 mt-4">{{ $cliente->direccion }}</p>

                        <p class="text-gray-600 dark:text-gray-400 mt-4">{{ $cliente->telefono }}</p>

                        <p class="text-gray-600 dark:text-gray-400 mt-4">{{ $cliente->email }}</p>

                    </div>

                    <div class="flex justify-between mt-4">
                        <div class="flex items-center mr-2">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Total a Pagar:</h2>
                            <p class="text-lg font-bold text-lime-500 ml-2">
                                ${{ $expediente->costo }}
                            </p>
                        </div>
                        <div class="flex items-center mr-2">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mr-2">Estado:</h2>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $expediente->estadoExpediente === 'Pendiente' ? 'bg-yellow-900 text-yellow-200' : '' }}
                                            {{ $expediente->estadoExpediente === 'En Proceso' ? 'bg-blue-900 text-blue-200' : '' }}
                                            {{ $expediente->estadoExpediente === 'Cancelado' ? 'bg-red-900 text-red-200' : '' }}
                                            {{ $expediente->estadoExpediente === 'Completado' ? 'bg-green-900 text-green-200' : '' }}">
                                {{ $expediente->estadoExpediente }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <x-primary-button>Crear Reporte</x-primary-button>

                    <x-secondary-button>Orden servicio</x-secondary-button>
                </div>

                <div class="p-6 mt-11">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text-black dark:text-white">Equipo:</h1>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $expediente->equipo }}</h2>
                        </div>

                        <div>
                            <h1 class="text-black dark:text-white">Problema:</h1>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $expediente->problema }}</h2>
                        </div>

                        <div>
                            <h1 class="text-black dark:text-white">Observacion:</h1>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $expediente->observacion }}</h2>
                        </div>
                    </div>
                </div>

                <div class="p-6 mt-11">
                    <div class="flex justify-between">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
