<?php

namespace App\Exports;

use DB;
use App\Models\Establecimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EstablecimientoExport implements FromCollection,WithHeadings
{

    public function headings(): array
    {
        return [
            'Id',
            'Id Usuario',
            'Nombre',
            'Descripcion',
            'Giro',
            'Lista de productos',
            'C.P.',
            'Calle',
            'Número',
            'Colonia',
            'Ciudad',
            'Telefono',
            'WhatsApp',
            'Email Negocio',
            'Entrega a domicilio',
            'Manos por Guanajuato',
            'Celular',
            'Facebook',
            'Instagram',
            'Web',
            'Trueques',
            'Likes',
            'Interior',
            'Entre calles',
            'Created At',
            'Deleted At',
            'Activo',
            'Coordenadas',
            'Usuario',
            'Slugs'
        ];
    }

    public function collection()
    {
        return Establecimiento::all();
    }
}
