<?php

namespace App\Livewire;

use App\Models\Cliente;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $columns = [
        'nombre' => true,
        'apellido' => true,
        'telefono' => true,
        'email' => true,
        'estado' => true,
    ];
    public $selected = [];
    public $selectAll = false;

    public function mount()
    {
        $this->perPage = 10;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('clienteAdd')]
    public function refreshClientes()
    {
        $this->resetPage();
    }

    #[On('clienteUpdate')]
    public function handleClienteUpdate()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('showConfirmDialog', [
            'id' => $id,
            'title' => '¿Estás seguro?',
            'text' => '¡No podrás revertir esto!',
            'icon' => 'warning',
            'confirmButtonText' => 'Sí, eliminar',
            'method' => 'deleteCliente'
        ]);
    }

    public function deleteCliente($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Eliminado!',
                'text' => 'El cliente ha sido eliminado.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage());

            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'No se pudo eliminar el cliente.'
            ]);
        }
    }

    public function render()
    {
        $clientes = Cliente::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('apellido', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('telefono', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.clientes', [
            'clientes' => $clientes,
            'totalClientes' => Cliente::count()
        ]);
    }
}
