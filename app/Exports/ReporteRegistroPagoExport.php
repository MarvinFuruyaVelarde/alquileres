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

class ReporteRegistroPagoExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $cliente;
    protected $gestion;
    protected $mes;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $cliente, $gestion, $mes)
    {
        $this->aeropuerto = $aeropuerto;
        $this->cliente = $cliente;
        $this->gestion = $gestion;
        $this->mes = $mes;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $registropagos = Reporte::reporteRegistroPago($this->aeropuerto, $this->cliente, $this->gestion, $this->mes);
        // Convertir el array en una colección
        $registropagos = collect($registropagos);

        // Usar map para agregar el atributo ci_nit
        return $registropagos->map(function ($registropago) {
            return [
                'cod_aeropuerto' => $registropago->aeropuerto ?? '',
                'cliente' => $registropago->cliente ?? '',
                'ci_nit' => $registropago->ci ?? $registropago->nit ?? '',
                'gestion' => $registropago->gestion ?? '',
                'mes' => $registropago->mes_literal ?? '',
                'fecha_nota_cobro' => $registropago->fecha_nota_cobro ?? '',
                'numero_nota_cobro' => $registropago->numero_nota_cobro ?? '',
                'fecha_emision_factura' => $registropago->fecha_emision_factura ?? '',
                'numero_factura' => $registropago->numero_factura ?? '',
                'tipo' => $registropago->tipo ?? '',
                'monto_factura' => $registropago->monto_factura ?? '',
                'pagado' => $registropago->pagado ?? '',
                'saldo' => $registropago->saldo ?? '',
                'fecha_pago' => $registropago->fecha_pago ?? '',
                'numero_registro_deposito' => $registropago->numero_registro_deposito ?? '',
                'numero_registro_cobro' => $registropago->numero_registro_cobro ?? '',
                'observacion' => $registropago->observacion ?? '',
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
            'GESTIÓN',
            'MES',
            'FECHA NOTA COBRO',
            'NÚMERO NOTA COBRO',
            'FECHA EMISIÓN FACTURA',
            'NÚMERO FACTURA',
            'TIPO',
            'MONTO FACTURA (BS.)',
            'PAGADO (BS.)',
            'SALDO (BS.)',
            'FECHA DE PAGO',
            'NRO. REG. DEP/CHQ/TRANS',
            'NRO. RECIBO COBRO',
            'OBSERVACIÓN',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Registro de Pagos';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE REGISTRO DE PAGOS";
                $sheet->setCellValue('A1', $title);
                $sheet->mergeCells('A1:Q1');
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
                foreach (range('A', 'Q') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }

                // Ajustar el alto de la fila del título
                $sheet->getRowDimension(1)->setRowHeight(60);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headerRange = 'A2:Q2';

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
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna GESTIÓN
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MES
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA NOTA COBRO
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO NOTA COBRO
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA EMISIÓN FACTURA
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NÚMERO FACTURA
                    'J' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO
                    'K' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna MONTO FACTURA (BS.)
                    'L' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna PAGADO (BS.)
                    'M' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna SALDO (BS.)
                    'N' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA DE PAGO
                    'O' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NRO. REG.DEP/CHQ/TRANS
                    'P' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NRO. RECIBO COBRO
                    'Q' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna OBSERVACIÓN
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
