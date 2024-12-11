<div>
    <x-primary-button wire:click="openModal">Crear Cliente</x-primary-button>

    <x-modal name="crear-cliente" wire:model="modalVisible">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $clienteId ? __('Editar Cliente') : __('Crear Nuevo Cliente') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="nombre" value="{{ __('Nombre') }}" />
                <x-text-input id="nombre" class="block w-full mt-1" type="text" wire:model.defer="nombre" />
                @error('nombre')<span class="mt-1 text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="apellido" value="{{ __('Apellido') }}" />
                <x-text-input id="apellido" class="block w-full mt-1" type="text" wire:model.defer="apellido" />
                @error('apellido')<span class="mt-1 text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="telefono" value="{{ __('Teléfono') }}" />
                <x-text-input id="telefono" class="block w-full mt-1" type="number" wire:model.defer="telefono" />
                @error('telefono')<span class="mt-1 text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="{{ __('Email') }}" />
                <x-text-input id="email" class="block w-full mt-1" type="email" wire:model.defer="email" />
                @error('email')<span class="mt-1 text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="direccion" value="{{ __('Dirección') }}" />
                <x-text-input id="direccion" class="block w-full mt-1" type="text" wire:model.defer="direccion" />
                @error('direccion')<span class="mt-1 text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="estado" value="{{ __('Estado') }}" />
                <select id="estado" class="block w-full mt-1 bg-gray-700 border-gray-300 rounded-md shadow-sm dark:border-gray-700" wire:model.defer="estado">
                    <option value="">Seleccione un estado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Completado">Completado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
                @error('estado')<span class="mt-1 text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div class="flex justify-end mt-6">
                <x-secondary-button wire:click="$set('modalVisible', false)" wire:loading.attr="disabled" class="mr-3">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-primary-button wire:click="save" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
