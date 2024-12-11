<div class="p-6 dark:bg-gray-900">

    <!-- Controles superiores -->
    <div class="flex items-center justify-between mb-4 mr-4">
        <div class="flex items-center gap-4">
            <!-- Buscador -->
            <div>
                <input wire:model.live="search" type="search" placeholder="Buscar Cliente..."
                    class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Selector de registros por página -->
            <div class="relative">
                <select wire:model.live="perPage"
                    class="w-full px-4 py-2 text-gray-200 bg-gray-800 border border-gray-700 rounded-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>10 por página</option>
                    <option>25 por página</option>
                    <option>50 por página</option>
                    <option>100 por página</option>
                </select>
            </div>


        </div>

        <!-- Botón de columnas -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="px-4 py-2 text-gray-200 bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                COLUMNAS
            </button>
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 z-10 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-700">
                @foreach ($columns as $column => $enabled)
                    <label class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-700">
                        <input type="checkbox" wire:model.live="columns.{{ $column }}"
                            class="text-blue-500 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                        {{ ucfirst($column) }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Total de registros -->
    <div class="mb-4">
        Total de clientes: {{ $totalClientes }}
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto overflow-y-auto bg-white rounded-lg shadow dark:bg-gray-800">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left bg-gray-100 dark:bg-gray-700">
                    <th class="px-6 py-3">
                        <input type="checkbox" wire:model.live="selectAll"
                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500">
                    </th>

                    @if ($columns['nombre'])
                        <th wire:click="sortBy('nombre')"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                            Nombre
                            @if ($sortField === 'nombre')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                    @endif
                    @if ($columns['apellido'])
                        <th wire:click="sortBy('apellido')"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                            Apellido
                            @if ($sortField === 'apellido')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                    @endif
                    @if ($columns['telefono'])
                        <th wire:click="sortBy('telefono')"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                            Teléfono
                            @if ($sortField === 'telefono')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                    @endif
                    @if ($columns['email'])
                        <th wire:click="sortBy('email')"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                            Email
                            @if ($sortField === 'email')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                    @endif
                    @if ($columns['estado'])
                        <th wire:click="sortBy('estado')"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                            Estado
                            @if ($sortField === 'estado')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                    @endif

                    <th
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                        Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($clientes as $cliente)
                    <tr class="hover:bg-gray-800/50">
                        <td class="px-6 py-4">
                            <input type="checkbox" value="{{ $cliente->id }}" wire:model.live="selected"
                                class="text-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500">
                        </td>

                        @if ($columns['nombre'])
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                {{ $cliente->nombre }}
                            </td>
                        @endif

                        @if ($columns['apellido'])
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                {{ $cliente->apellido }}
                            </td>
                        @endif

                        @if ($columns['telefono'])
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                {{ $cliente->telefono }}
                            </td>
                        @endif

                        @if ($columns['email'])
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                {{ $cliente->email }}
                            </td>
                        @endif

                        @if ($columns['estado'])
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs font-semibold leading-5 rounded-full
                                    {{ $cliente->estado === 'Pendiente' ? 'bg-yellow-900 text-yellow-200' : '' }}
                                    {{ $cliente->estado === 'Completado' ? 'bg-blue-900 text-blue-200' : '' }}
                                    {{ $cliente->estado === 'Cancelado' ? 'bg-red-900 text-red-200' : '' }}">
                                    {{ $cliente->estado }}
                                </span>
                            </td>
                        @endif

                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                            <div class="flex mr-2">

                                <x-primary-button wire:navigate href="{{ route('expedientes.show', $cliente->id) }}"
                                    class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    Ver Expedientes
                                </x-primary-button>
                                <x-secondary-button wire:click="$dispatch('editCliente', { id: {{ $cliente->id }} })"
                                    class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    Editar
                                </x-secondary-button>

                                <x-danger-button wire:click="confirmDelete({{ $cliente->id }})">
                                    Eliminar
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count(array_filter($columns)) + 2 }}"
                            class="px-6 py-4 text-center text-gray-500">
                            No se encontraron registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $clientes->links() }}
    </div>
</div>
