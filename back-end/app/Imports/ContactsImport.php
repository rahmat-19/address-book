<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'name' => $row['name'],
            'phone_number' => $row['phone_number'],
            'address' => $row['address'],
            'category' => $row['category'],
            'active' => $row['active'] == 'Active' ? 1 : 0 ,
            'user_id' => auth()->id(),
        ]);
    }
}
