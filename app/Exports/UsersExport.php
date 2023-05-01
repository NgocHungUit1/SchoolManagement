<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function query()
    {
        return User::query(Auth::user()->user_type == 2);
    }
}
