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

class ReporteFacturaExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $gestion;
    protected $mes;

    // Constructor para recibir parámetros
    public function __construct($gestion, $mes)
    {
        //dd($aeropuerto.' '.$tipoSolicitante.' '.$cliente.' '.$ciNit.' '.$estado);
        $this->gestion = $gestion;
        $this->mes = $mes;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $facturas = Reporte::reporteFactura($this->gestion, $this->mes);
        // Convertir el array en una colección
        $facturas = collect($facturas);

        // Usar map para agregar el atributo ci_nit
        return $facturas->map(function ($factura) {
            return [
                'codigo' => $factura->codigo ?? '',
                'razon_social' => $factura->razon_social ?? '',
                'gestion' => $factura->gestion ?? '',
                'mes' => $factura->mes_literal ?? '',
                'numero_nota_cobro' => $factura->numero_nota_cobro ?? '',
                'tipo_factura' => $factura->tipo_factura ?? '',
                'numero_factura' => $factura->numero_factura ?? '',
                'monto_total' => $factura->monto_total ?? '',
                'estado' => $factura->estado ?? '',
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'AEROPUERTO',
            'CLIENTE',
            'GESTIÓN',
            'MES',
            'NÚMERO NOTA DE COBRO',
            'TIPO FACTURA',
            'NÚMERO DE FACTURA',
            'MONTO TOTAL (BS)',
            'ESTADO',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Facturas';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE FACTURAS/NOTAS DE COBRO";
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
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna GESTION
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MES
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO NOTA DE COBRO
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO FACTURA
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO DE FACTURA
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MONTO TOTAL
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
