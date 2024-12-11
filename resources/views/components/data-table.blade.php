<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($title)
                        <h2 class="text-xl font-semibold mb-4">{{ $title }}</h2>
                    @endif

                    <!-- Header con búsqueda y configuración -->
                    <div class="mb-4 flex justify-between items-center">
                        <div class="flex items-center">
                            <input
                                wire:model.live="search"
                                type="search"
                                placeholder="Buscar..."
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                            <select wire:model.live="perPage" class="ml-4 rounded-md shadow-sm border-gray-300">
                                <option value="10">10 por página</option>
                                <option value="25">25 por página</option>
                                <option value="50">50 por página</option>
                                <option value="100">100 por página</option>
                            </select>
                        </div>

                        <!-- Selector de columnas -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="px-4 py-2 bg-gray-100 rounded-md">
                                Columnas
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-10">
                                @foreach($columns as $column)
                                <label class="px-4 py-2 hover:bg-gray-100 flex items-center">
                                    <input type="checkbox" wire:model.live="visibleColumns.{{ $column }}" class="mr-2">
                                    {{ $customHeaders[$column] ?? ucfirst($column) }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Total de registros -->
                    <div class="mb-4">
                        Total de registros: {{ $total }}
                    </div>

                    <!-- Tabla -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach($columns as $column)
                                        @if($visibleColumns[$column])
                                        <th wire:click="sortBy('{{ $column }}')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                            {{ $customHeaders[$column] ?? ucfirst($column) }}
                                            @if($sortField === $column)
                                                @if($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($data as $item)
                                <tr>
                                    @foreach($columns as $column)
                                        @if($visibleColumns[$column])
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($column === 'estado')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $item->$column === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $item->$column === 'Actualizar' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $item->$column === 'Cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ $item->$column }}
                                                </span>
                                            @else
                                                {{ $item->$column }}
                                            @endif
                                        </td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
