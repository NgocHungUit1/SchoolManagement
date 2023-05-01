<?php

namespace App\Exports;

use App\Models\ClassSubject;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssignSubjectExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ClassSubject::all();
    }
}
