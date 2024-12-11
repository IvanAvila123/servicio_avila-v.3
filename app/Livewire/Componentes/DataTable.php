<?php

namespace App\Livewire\Componentes;

use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Support\Collection;

class DataTable extends Component
{
    use WithPagination;

    public $model;
    public $columns;
    public $searchColumns = [];
    public $customHeaders = [];
    public $title;
    public Collection $rows;
    public $selected = [];
    public $selectAll = false;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $visibleColumns = [];

    public function mount($model, $columns, $searchColumns = [], $customHeaders = [], $title = '')
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->searchColumns = $searchColumns;
        $this->customHeaders = $customHeaders;
        $this->title = $title;

        // Inicializar columnas visibles
        foreach ($columns as $column) {
            $this->visibleColumns[$column] = true;
        }
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

    public function toggleColumn($column)
    {
        $this->visibleColumns[$column] = !$this->visibleColumns[$column];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $query = $this->model::query();

        if ($this->search && !empty($this->searchColumns)) {
            $query->where(function($query) {
                foreach ($this->searchColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }

        $data = $query->orderBy($this->sortField, $this->sortDirection)
                     ->paginate($this->perPage);

        $this->rows = collect($data->items());

        return view('livewire.componentes.data-table', [
            'data' => $data,
            'total' => $this->model::count(),
            'actions' => $this->slots()
        ]);
    }

    protected function slots()
    {
        $slots = [];
        foreach ($this->rows as $item) {
            $slots['actions_'.$item->id] = $this->slots['actions_'.$item->id] ?? '';
        }
        return $slots;
    }
}
