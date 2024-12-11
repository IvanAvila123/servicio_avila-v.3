<div class="p-6 dark:bg-gray-900">
    <!-- Encabezado con título -->
    @if($title)
        <h2 class="mb-6 text-2xl font-semibold dark:text-white">{{ $title }}</h2>
    @endif

    <!-- Controles superiores -->
    <div class="flex items-center justify-between mb-4 mr-4">
        <div class="flex items-center gap-4">
            <!-- Buscador -->
            <div>
                <input
                    wire:model.live="search"
                    type="search"
                    placeholder="Buscar Cliente..."
                    class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none"
                >
            </div>

            <!-- Selector de registros por página -->
            <div class="relative">
                <select
                    wire:model.live="perPage"
                    class="w-full px-4 py-2 text-gray-200 bg-gray-800 border border-gray-700 rounded-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option>10 por página</option>
                    <option>25 por página</option>
                    <option>50 por página</option>
                    <option>100 por página</option>
                </select>
            </div>
        </div>

        <!-- Botón de columnas -->
        <div class="relative" x-data="{ open: false }">
            <button
                @click="open = !open"
                class="px-4 py-2 text-gray-200 bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                COLUMNAS
            </button>
            <div
                x-show="open"
                @click.away="open = false"
                class="absolute right-0 z-10 w-48 py-2 mt-2 bg-gray-800 rounded-lg shadow-xl"
            >
                @foreach($columns as $column)
                <label class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-700">
                    <input
                        type="checkbox"
                        wire:model.live="visibleColumns.{{ $column }}"
                        class="text-blue-500 bg-gray-700 border-gray-600 rounded focus:ring-blue-500"
                    >
                    <span class="ml-2 text-gray-200">{{ $customHeaders[$column] ?? ucfirst($column) }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Total de registros -->
    <div class="mb-4 text-gray-400">
        Total de registros: {{ $total }}
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto overflow-y-auto bg-white rounded-lg shadow dark:bg-gray-800">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left bg-gray-100 dark:bg-gray-700">
                    <th class="px-6 py-3">
                        <input
                            type="checkbox"
                            wire:model.live="selectAll"
                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500"
                        >
                    </th>
                    @foreach($columns as $column)
                        @if($visibleColumns[$column])
                        <th
                            wire:click="sortBy('{{ $column }}')"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase cursor-pointer hover:bg-gray-700/50"
                        >
                            <div class="flex items-center space-x-1">
                                <span>{{ $customHeaders[$column] ?? ucfirst($column) }}</span>
                                @if($sortField === $column)
                                    <span class="text-blue-500">
                                        @if($sortDirection === 'asc') ↑ @else ↓ @endif
                                    </span>
                                @endif
                            </div>
                        </th>
                        @endif
                    @endforeach
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-800/50">
                        <td class="px-6 py-4">
                            <input
                                type="checkbox"
                                value="{{ $item->id }}"
                                wire:model.live="selected"
                                class="text-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500"
                            >
                        </td>
                        @foreach($columns as $column)
                            @if($visibleColumns[$column])
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                @if($column === 'estado')
                                    <span class="px-2 py-1 text-xs font-semibold leading-5 rounded-full
                                        {{ $item->$column === 'Pendiente' ? 'bg-yellow-900 text-yellow-200' : '' }}
                                        {{ $item->$column === 'Completado' ? 'bg-blue-900 text-blue-200' : '' }}
                                        {{ $item->$column === 'Cancelado' ? 'bg-red-900 text-red-200' : '' }}">
                                        {{ $item->$column }}
                                    </span>
                                @else
                                    {{ $item->$column }}
                                @endif
                            </td>
                            @endif
                        @endforeach
                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                            {{ ${'actions_'.$item->id} ?? '' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count(array_filter($visibleColumns)) + 2 }}" class="px-6 py-4 text-center text-gray-500">
                            No se encontraron registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $data->links() }}
    </div>
</div>
