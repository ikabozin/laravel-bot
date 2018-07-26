<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.07.18
 * Time: 16:28
 */

namespace App\Excel;


use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

    /**
     * @return Collection
     */
    public function collection()
    {
        return User::all();
    }
}