<?php

namespace App\Imports;

use App\Models\Mark;
use Maatwebsite\Excel\Concerns\ToModel;

class MarksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         return Mark::updateOrCreate(
            ['student_id' => $row['student_id'], 'subject_id' => $row['subject_id']],
            ['mark' => $row['mark']]
        );
    }
}
