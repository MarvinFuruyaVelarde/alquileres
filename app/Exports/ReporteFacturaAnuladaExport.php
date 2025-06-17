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

class ReporteFacturaAnuladaExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $cliente;
    protected $tipoFactura;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $cliente, $tipoFactura)
    {
        //dd($aeropuerto.' '.$tipoSolicitante.' '.$cliente.' '.$ciNit.' '.$estado);
        $this->aeropuerto = $aeropuerto;
        $this->cliente = $cliente;
        $this->tipoFactura = $tipoFactura;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $facturasAnuladas = Reporte::reporteFacturaAnulada( $this->aeropuerto, $this->cliente, $this->tipoFactura);
        // Convertir el array en una colección
        $facturasAnuladas = collect($facturasAnuladas);

        // Usar map para agregar el atributo ci_nit
        return $facturasAnuladas->map(function ($facturaAnulada) {
            return [
                'codigo_aeropuerto' => $facturaAnulada->codigo_aeropuerto ?? '',
                'razon_social' => $facturaAnulada->razon_social ?? '',
                'codigo_contrato' => $facturaAnulada->codigo_contrato ?? '',
                'numero_nota_cobro' => $facturaAnulada->numero_nota_cobro ?? '',
                'mes' => $facturaAnulada->mes ?? '',
                'gestion' => $facturaAnulada->gestion ?? '',
                'tipo_factura' => $facturaAnulada->tipo_factura ?? '',
                'monto_total' => $facturaAnulada->monto_total ?? '',
                'numero_factura' => $facturaAnulada->numero_factura ?? '',
                'fecha_emision' => $facturaAnulada->fecha_emision ?? '',
                'usuario' => $facturaAnulada->usuario ?? '',
                'fecha_anulacion' => $facturaAnulada->fecha_anulacion ?? '',
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
            'CODIGO CONTRATO',
            'NUMERO NOTA DE COBRO',
            'MES',
            'GESTIÓN',
            'TIPO',
            'MONTO TOTAL (BS)',
            'NÚMERO FACTURA',
            'FECHA EMISIÓN',
            'ANULADO POR',
            'FECHA ANULACIÓN',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Facturas Anuladas';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE FACTURAS ANULADAS";
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
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CÓDIGO CONTRATO
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NUMERO NOTA DE COBRO
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MES
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna GESTIÓN
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MONTO TOTAL (BS)
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO FACTURA
                    'J' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA EMISIÓN
                    'K' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna ANULADO POR
                    'L' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA ANULACIÓN
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
