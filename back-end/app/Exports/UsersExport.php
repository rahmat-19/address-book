<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping,  WithStyles, WithColumnFormatting
{
    protected $filter;
    public function __construct($filter)
    {
        $this->filter = $filter;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::latest()->fillter($this->filter)->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone Number',
            'Active',
            'Category',
            'Address',
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            "'+62"  .'82145035990', // Nomor telepon dengan kode negara +62
            $user->active ? 'Active' : 'Not Active',
            $user->category,
            $user->address,

        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->collection()->count() + 1;

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:E' . $rowCount)->applyFromArray($styleArray);

        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFF00']
            ],
        ]);

         $sheet->getColumnDimension('A')->setWidth(15); 
         $sheet->getColumnDimension('B')->setWidth(15); 
         $sheet->getColumnDimension('E')->setWidth(30); 

         $sheet->getStyle('E')->getAlignment()->setWrapText(true);
         $sheet->getStyle('A')->getAlignment()->setWrapText(true);

        return [];
        
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT, 
        ];
    }
}
