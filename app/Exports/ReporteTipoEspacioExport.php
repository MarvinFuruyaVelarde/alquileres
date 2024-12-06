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

class ReporteTipoEspacioExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $cliente;
    protected $tipoEspacio;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $cliente, $tipoEspacio)
    {
        $this->aeropuerto = $aeropuerto;
        $this->cliente = $cliente;
        $this->tipoEspacio = $tipoEspacio;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tipoEspacios = Reporte::reporteTipoEspacio($this->aeropuerto, $this->cliente, $this->tipoEspacio);
        // Convertir el array en una colección
        $tipoEspacios = collect($tipoEspacios);

        // Usar map para agregar el atributo ci_nit
        return $tipoEspacios->map(function ($tipoEspacio) {
            return [
                'cod_aeropuerto' => $tipoEspacio->cod_aeropuerto ?? '',
                'cliente' => $tipoEspacio->cliente ?? '',
                'representante' => $tipoEspacio->tipo_espacio ?? '',
                'tipo_solicitante' => $tipoEspacio->rubro ?? '',
                'ci_nit' => $tipoEspacio->objeto_contrato ?? '',
                'domicilio_legal' => $tipoEspacio->canon_mensual ?? '',
                'telefono' => $tipoEspacio->fecha_inicial ?? '',
                'correo' => $tipoEspacio->fecha_final ?? '',
                'estado' => $tipoEspacio->codigo_contrato ?? '',
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
            'TIPO DE ESPACIO',
            'RUBRO',
            'OBJETO DE CONTRATO',
            'CANON MENSUAL (BS)',
            'FECHA INICIAL',
            'FECHA FINAL',
            'CÓDIGO CONTRATO',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Tipo de Espacios';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE TIPO DE ESPACIOS";
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
                    'A' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna COD. AEROPUERTO
                    'B' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CLIENTE
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO DE ESPACIO
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna RUBRO
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna OBJETO DE CONTRATO
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CANON MENSUAL
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA INICIAL
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA FINAL
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CODIGO DE CONTRATO
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
