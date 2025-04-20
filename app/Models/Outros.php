<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outros
{
    use HasFactory;

    public function getEmployees(): array
    {
        return DB::select(<<<SQL
            select *
            from employees
            limit 100
        SQL);
    }

    public function getSalaries(): array
    {
        return DB::select(<<<SQL
            select *
            from salaries
            limit 1
        SQL);
    }
}
