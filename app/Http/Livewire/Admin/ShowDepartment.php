<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department;
use Livewire\Component;

class ShowDepartment extends Component
{
    public $department;


    public function mount(Department $department)
    {
        $this->department = $department;
    }

    public function render(Department $department)
    {
        return view('livewire.admin.show-department')->layout('layouts.admin');
    }
}
