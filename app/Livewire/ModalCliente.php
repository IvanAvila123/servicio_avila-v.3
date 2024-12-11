<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalCliente extends Component
{
    public $modalVisible = false;
    public $cliente;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $direccion;
    public $estado;
    public $clienteId;

    protected function rules()
    {
        $rules  = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'required|string',
            'email' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:Pendiente,Completado,Cancelado'
        ];

        return $rules;
    }


    public function openModal()
    {
        $this->modalVisible = true;
    }

    #[On('editCliente')]
    public function show($id)
    {
        $this->clienteId = $id;
        $cliente = Cliente::find($id);
        if ($cliente) {
            $this->nombre = $cliente->nombre;
            $this->apellido = $cliente->apellido;
            $this->telefono = $cliente->telefono;
            $this->email = $cliente->email;
            $this->direccion = $cliente->direccion;
            $this->estado = $cliente->sistema;
            $this->modalVisible = true;  // Open the modal
        }
    }

    public function save()
{
    $this->validate();

    try {
        $data = [
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'estado' => $this->estado,
        ];

        if ($this->clienteId) {
            $cliente = Cliente::find($this->clienteId);
            if ($cliente) {
                $cliente->update($data);
                $this->dispatch('clienteUpdate');
                $message = 'Cliente actualizado correctamente';
            }
        } else {
            Cliente::create($data);
            $this->dispatch('clienteAdd');
            $message = 'Cliente creado correctamente';
        }

        $this->dispatch('close-modal', 'crear-cliente');
        $this->reset();

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => $message
        ]);

    } catch (\Exception $e) {
        $this->dispatch('showToast', [
            'type' => 'error',
            'message' => 'Error al guardar el cliente: ' . $e->getMessage()
        ]);
    }
}

    public function render()
    {
        return view('livewire.modal-cliente');
    }
}
