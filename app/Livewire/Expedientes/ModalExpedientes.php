<?php

namespace App\Livewire\Expedientes;

use App\Models\Cliente;
use App\Models\Expediente;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalExpedientes extends Component
{
    public $modalVisible = false;
    public $cliente_id;
    public $expediente_id = null;
    public $expediente;

    // Campos requeridos
    public $equipo = '';
    public $problema = '';
    public $fecha;
    public $estadoExpediente = 'Pendiente';
    public $costo = 0;


    protected function rules()
    {
        $rules  = [
            'equipo' => 'required|string|max:255',
            'problema' => 'required|string|max:255',
            'fecha' => 'required|date',
            'estadoExpediente' => 'required|in:Pendiente,En Proceso,Completado,Cancelado',
            'costo' => 'required|numeric|min:0',
            'cliente_id' => 'required|integer',
        ];

        return $rules;
    }

    public function mount($clienteId = null)
    {
        $this->cliente_id = $clienteId;
        $this->fecha = now()->format('Y-m-d'); // Establece la fecha actual por defecto
    }

    public function openModal()
    {
        $this->modalVisible = true;
    }

    #[On('editExpediente')]
    public function show($id)
    {
        $this->expediente_id = $id;
        $expediente = Expediente::find($id);
        if ($expediente) {
            $this->equipo = $expediente->equipo;
            $this->problema = $expediente->problema;
            $this->fecha = $expediente->fecha;
            $this->estadoExpediente = $expediente->estadoExpediente;
            $this->costo = $expediente->costo;
            $this->modalVisible = true;  // Open the modal
        }
    }

    public function save()
{
    $this->validate();

    try {
        $data = [
            'equipo' => $this->equipo,
            'problema' => $this->problema,
            'fecha' => $this->fecha,
            'estadoExpediente' => $this->estadoExpediente,
            'costo' => $this->costo,
            'cliente_id' => $this->cliente_id,
        ];

        if ($this->expediente_id) {
            $expediente = Expediente::find($this->expediente_id);
            if ($expediente) {
                $expediente->update($data);
                $this->dispatch('expedienteUpdate');
                $message = 'Expediente actualizado correctamente';
            }
        } else {
            Expediente::create($data);
            $this->dispatch('expedienteAdd');
            $message = 'Expediente creado correctamente';
        }

        $this->dispatch('close-modal', 'crear-expediente');
        $this->reset();

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => $message
        ]);

    } catch (\Exception $e) {
        $this->dispatch('showToast', [
            'type' => 'error',
            'message' => 'Error al guardar el Expediente: ' . $e->getMessage()
        ]);
    }
}

    public function render()
    {
        return view('livewire.expedientes.modal-expedientes');
    }
}
