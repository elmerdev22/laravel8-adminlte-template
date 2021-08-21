<?php

namespace App\Http\Livewire\BackEnd\Employees\Profile;

use Livewire\Component;
use App\Models\Attendance as Attendances;

class Attendance extends Component
{
    public $employee_id;

    public function mount($employee_id){
        $this->employee_id = $employee_id;
    }

    public function data(){
        $data       = Attendances::where('employee_id', $this->employee_id)->get();
        // $collection = [];

        // foreach($data as $item){
        //     $collection[] = [
        //         'title'           => $item->type,
        //         'start'           => date('Y-m-d', strtotime($item->created_at)),
        //         'backgroundColor' => '#28a745',
        //         'borderColor'     => '#28a745',
        //         'allDay'          => true
        //     ];
        // }

        return $data;
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.employees.profile.attendance', compact('data'));
    }
}
