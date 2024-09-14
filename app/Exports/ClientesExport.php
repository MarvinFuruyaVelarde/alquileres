<?php

namespace App\Exports;

use App\Models\View_Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ClientesExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return View_Cliente::select('id', 'razon_social', 'desc_tipoidentificacion', 'numero_identificacion', 'desc_esaerolinea', 'desc_espssat', 'desc_tiposolicitante', 'desc_expedido', 'desc_estado')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'N°',
            'RAZÓN SOCIAL',
            'TIPO IDENTIFICACIÓN',
            'NRO. IDENTIFICACIÓN',
            '¿ES AEROLINEA?',
            'ES PRESTADOR DE SERVICIOS SAT',
            'TIPO SOLICITANTE',
            'EXPEDIDO',
            'ESTADO',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Aeropuertos';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->sheet;

                // Establecer el título con salto de línea
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nCLIENTES";
                $sheet->setCellValue('A1', $title);
                $sheet->mergeCells('A1:I1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'underline' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                ]);

                // Ajustar el ancho de las columnas
                foreach (range('A', 'I') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }

                // Ajustar el alto de la fila del título
                $sheet->getRowDimension(1)->setRowHeight(60);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headerRange = 'A2:I2';

                // Aplicar estilos a los encabezados
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => '000000'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Aplicar estilos a las columnas
                $columns = [
                    'A' => Alignment::HORIZONTAL_CENTER, // Alinear a la izquierda para la columna ID
                    'B' => Alignment::HORIZONTAL_LEFT, // Alinear a la izquierda para la columna DESCRIPCIÓN
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                ];

                foreach ($columns as $columnID => $horizontalAlignment) {
                    $sheet->getStyle($columnID)->applyFromArray([
                        'alignment' => [
                            'horizontal' => $horizontalAlignment,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);
                }
            },
        ];
    }
}
