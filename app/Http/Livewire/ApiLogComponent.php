<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ApiLog;

class ApiLogComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $logs = ApiLog::orderBy('id' , 'desc')->paginate(20);

        $data = [
            'logs' => $logs
        ];

        return view('livewire.api-log-component' , $data);
    }
}
