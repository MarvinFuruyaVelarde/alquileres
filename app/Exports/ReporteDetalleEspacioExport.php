<?php

namespace App\Exports;

use App\Models\Reporte;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReporteDetalleEspacioExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $cliente;
    protected $totalCanonMensual;
    protected $estado;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $cliente, $totalCanonMensual, $estado)
    {
        //dd($aeropuerto.' '.$tipoSolicitante.' '.$cliente.' '.$ciNit.' '.$estado);
        $this->aeropuerto = $aeropuerto;
        $this->cliente = $cliente;
        $this->totalCanonMensual = $totalCanonMensual;
        $this->estado = $estado;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //$contratos = Reporte::reporteContrato($this->aeropuerto, $this->tipoSolicitante, $this->cliente, $this->ciNit, $this->estado);
        //return collect($contratos);

        $detalleEspacios = Reporte::reporteDetalleEspacio($this->aeropuerto, $this->cliente, $this->totalCanonMensual, $this->estado);
        // Convertir el array en una colección
        $detalleEspacios = collect($detalleEspacios);

        // Usar map para agregar el atributo ci_nit
        return $detalleEspacios->map(function ($detalleEspacio) {
            return [
                'cod_aeropuerto' => $detalleEspacio->cod_aeropuerto ?? '',
                'cliente' => $detalleEspacio->cliente ?? '',
                'objeto_contrato' => $detalleEspacio->objeto_contrato ?? '',
                'ubicacion' => $detalleEspacio->ubicacion ?? '',
                'superficie' => $detalleEspacio->superficie ?? '',
                'desc_unidad_medida' => $detalleEspacio->desc_unidad_medida ?? '',
                'precio_unitario' => $detalleEspacio->precio_unitario ?? '',
                'total_canonmensual' => $detalleEspacio->total_canonmensual ?? '',
                'fecha_inicial' => $detalleEspacio->fecha_inicial ?? '',
                'fecha_final' => $detalleEspacio->fecha_final ?? '',
                'codigo_contrato' => $detalleEspacio->codigo_contrato ?? '',
                'estado' => $detalleEspacio->estado ?? '',
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
            'OBJETO DE CONTRATO',
            'UBICACIÓN',
            'SUPERFICIE',
            'UNIDAD DE MEDIDA',
            'PRECIO UNITARIO (BS)',
            'TOTAL CANON MENSUAL',
            'FECHA INICIAL',
            'FECHA FINAL',
            'CODIGO CONTRATO',
            'ESTADO',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Detalle de Espacios';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE DETALLE DE ESPACIOS";
                $sheet->setCellValue('A1', $title);
                $sheet->mergeCells('A1:L1');
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
                foreach (range('A', 'L') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }

                // Ajustar el alto de la fila del título
                $sheet->getRowDimension(1)->setRowHeight(60);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headerRange = 'A2:L2';

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
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna REPRESENTANTE
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO SOLICITANTE
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NIT/CI
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna DOMICILIO LEGAL
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TELÉFONO/CELULAR
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CORREO
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
                    'J' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TELÉFONO/CELULAR
                    'K' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CORREO
                    'L' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ESTADO
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
