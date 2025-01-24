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

class ReporteCuentaPorCobrarExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $cliente;
    protected $fechaInicial;
    protected $fechaFinal;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $cliente, $fechaInicial, $fechaFinal)
    {
        $this->aeropuerto = $aeropuerto;
        $this->cliente = $cliente;
        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cuentasporcobrar = Reporte::reporteCuentaPorCobrar($this->aeropuerto, $this->cliente, $this->fechaInicial, $this->fechaFinal);
        // Convertir el array en una colección
        $cuentasporcobrar = collect($cuentasporcobrar);

        // Usar map para agregar el atributo ci_nit
        return $cuentasporcobrar->map(function ($cuentaporcobrar) {
            return [
                'cod_aeropuerto' => $cuentaporcobrar->cod_aeropuerto ?? '',
                'cliente' => $cuentaporcobrar->cliente ?? '',
                'ci_nit' => $cuentaporcobrar->ci ?? $cuentaporcobrar->nit ?? '',
                'gestion' => $cuentaporcobrar->gestion ?? '',
                'mes' => $cuentaporcobrar->mes ?? '',
                'fecha_nota_cobro' => $cuentaporcobrar->fecha_nota_cobro ?? '',
                'numero_nota_cobro' => $cuentaporcobrar->numero_nota_cobro ?? '',
                'fecha_emision_factura' => $cuentaporcobrar->fecha_emision_factura ?? '',
                'numero_factura' => $cuentaporcobrar->numero_factura ?? '',
                'tipo' => $cuentaporcobrar->tipo ?? '',
                'monto_facturado' => $cuentaporcobrar->monto_facturado ?? '',
                'monto_pagado' => $cuentaporcobrar->monto_pagado ?? '',           
                'saldo' => $cuentaporcobrar->saldo ?? '',
                'fecha_pago' => $cuentaporcobrar->fecha_pago ?? '',
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
            'CI/NIT',
            'GESTION',
            'MES',
            'FECHA NOTA DE COBRO',
            'NÚMERO NOTA DE COBRO',
            'FECHA EMISIÓN FACTURA',
            'NÚMERO FACTURA',
            'TIPO',
            'MONTO FACTURA',
            'PAGADO',
            'SALDO',
            'FECHA DE PAGO',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Cuentas por Cobrar';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE CUENTAS POR COBRAR";
                $sheet->setCellValue('A1', $title);
                $sheet->mergeCells('A1:N1');
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
                foreach (range('A', 'N') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }

                // Ajustar el alto de la fila del título
                $sheet->getRowDimension(1)->setRowHeight(60);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headerRange = 'A2:N2';

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
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CI/NIT
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna GESTION
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MES
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA NOTA DE COBRO
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO NOTA DE COBRO
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA EMISIÓN FACTURA
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO FACTURA
                    'J' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO
                    'K' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MONTO FACTURA
                    'L' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna PAGADO
                    'M' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna SALDO
                    'N' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA DE PAGO
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
