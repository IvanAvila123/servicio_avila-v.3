<?php

namespace App\Livewire\Expedientes;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ShowExpedientes extends Component
{
    use WithPagination;

    public $cliente;
    public $search = '';
    public $perPage = 10;

    public function mount($id_cliente)
    {
        $this->cliente = Cliente::findOrFail($id_cliente);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $expedientes = $this->cliente->expedientes()
            ->when($this->search, function($query) {
                $query->where(function($query) {
                    $query->where('equipo', 'like', '%' . $this->search . '%')
                          ->orWhere('problema', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.expedientes.show-expedientes', [
            'expedientes' => $expedientes
        ])->layout('layouts.app');
    }
}
