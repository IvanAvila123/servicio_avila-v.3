<?php

namespace App\Livewire\Expedientes;

use App\Models\Cliente;
use App\Models\Expediente;
use Livewire\Component;
use Livewire\WithPagination;

class ShowExpediente extends Component
{
    use WithPagination;

    public $expedienteId;
    public $expediente;
    public $cliente;
    public $search = '';
    public $perPage = 10;

    // Recibe el parámetro de la ruta
    public function mount($hash, $id_cliente)
    {
        $id = Expediente::decodeHash($hash);
        $this->expedienteId = $id;
        $this->cliente = Cliente::findOrFail($id_cliente);
        $this->expediente = Expediente::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.expedientes.show-expediente', [
            'expediente' => $this->expediente
        ])->layout('layouts.app');
    }
}
