<?php

namespace App\Exports;

use App\Models\Reporte;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReporteMoraExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $cliente;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $cliente)
    {
        $this->aeropuerto = $aeropuerto;
        $this->cliente = $cliente;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $moras = Reporte::reporteMora($this->aeropuerto, $this->cliente);
        // Convertir el array en una colección
        $moras = collect($moras);

        // Usar map para agregar el atributo ci_nit
        return $moras->map(function ($mora) {
            return [
                'codigo' => $mora->codigo ?? '',
                'cliente' => $mora->cliente ?? '',
                'tipo_factura' => $mora->tipo_factura ?? '',
                'numero_factura' => $mora->numero_factura ?? '',
                'fecha_max_pago' => $mora->fecha_max_pago ?? '',
                'dia_mora' => $mora->dia_mora ?? '',
                'monto_a_pagar' => $mora->monto_a_pagar ?? '',
                'monto_pagado' => $mora->monto_pagado ?? '',
                'saldo' => $mora->saldo ?? '',
                'mora' => $mora->mora ?? '',                
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'COD. AEROPUERTO',
            'CLIENTE',
            'TIPO FACTURA',
            'NUMERO FACTURA',
            'FECHA MAX. PAGO',
            'DIA(S) MORA',
            'MONTO A PAGAR',
            'MONTO PAGADO',
            'SALDO',
            'MORA',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Mora';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE MORA";
                $sheet->setCellValue('A1', $title);
                $sheet->mergeCells('A1:J1');
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
                foreach (range('A', 'J') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }

                // Ajustar el alto de la fila del título
                $sheet->getRowDimension(1)->setRowHeight(60);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headerRange = 'A2:J2';

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
                    'A' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna COD. AEROPUERTO
                    'B' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CLIENTE
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO FACTURA
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NUMERO FACTURA
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA MAX. PAGO
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna DIA(S) MORA
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MONTO A PAGAR
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MONTO PAGADO
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna SALDO
                    'J' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MORA
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
