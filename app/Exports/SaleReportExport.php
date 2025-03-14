<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaleReportExport implements FromCollection,WithHeadings
{
    protected $data;
   public function __construct($data){
     $this->data = $data;
   }
   public function collection(){
    return collect($this->data);
   }
   public function headings(): array
    {
        // Define los encabezados del archivo Excel
        return [
            'Código Venta',
            'Nombre Cliente',
            'Identificación Cliente',
            'Correo Cliente',
            'Cantidad de productos',
            'Monto Total',
            'Fecha y Hora',
        ];
    }
}
