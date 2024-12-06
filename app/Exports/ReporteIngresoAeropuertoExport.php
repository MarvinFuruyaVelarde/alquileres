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

class ReporteIngresoAeropuertoExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $fechaInicial;
    protected $fechaFinal;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $fechaInicial, $fechaFinal)
    {
        $this->aeropuerto = $aeropuerto;
        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ingresoAeropuertos = Reporte::reporteIngresoAeropuerto($this->aeropuerto, $this->fechaInicial, $this->fechaFinal);
        // Convertir el array en una colección
        $ingresoAeropuertos = collect($ingresoAeropuertos);

        // Usar map para agregar el atributo ci_nit
        return $ingresoAeropuertos->map(function ($ingresoAeropuerto) {
            return [
                'cod_aeropuerto' => $ingresoAeropuerto->cod_aeropuerto ?? '',
                'desc_aeropuerto' => $ingresoAeropuerto->desc_aeropuerto ?? '',
                'total_ingreso' => $ingresoAeropuerto->total_ingreso ?? '',
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
            'AEROPUERTO',
            'TOTAL INGRESO (BS)',            
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Ingresos por Aeropuerto';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE INGRESOS POR AEROPUERTO";
                $sheet->setCellValue('A1', $title);
                $sheet->mergeCells('A1:C1');
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
                foreach (range('A', 'C') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }

                // Ajustar el alto de la fila del título
                $sheet->getRowDimension(1)->setRowHeight(60);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headerRange = 'A2:C2';

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
                    'B' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna DESC. AEROPUERTO
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TOTAL INGRESO
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
