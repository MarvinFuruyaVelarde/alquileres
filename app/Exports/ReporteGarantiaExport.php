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

class ReporteGarantiaExport implements FromCollection, WithHeadings, WithTitle, WithEvents
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
        $garantias = Reporte::reporteGarantia($this->aeropuerto, $this->cliente);
        // Convertir el array en una colección
        $garantias = collect($garantias);

        // Usar map para agregar el atributo ci_nit
        return $garantias->map(function ($garantia) {
            return [
                'cod_aeropuerto' => $garantia->cod_aeropuerto ?? '',
                'cliente' => $garantia->cliente ?? '',
                'codigo_contrato' => $garantia->codigo_contrato ?? '',
                'garantia' => $garantia->garantia ?? '',
                'pagado' => $garantia->pagado ?? '',
                'saldo' => $garantia->saldo ?? '',
                'fecha_pago' => $garantia->fecha_pago ?? '',
                'fecha_deposito' => $garantia->fecha_deposito ?? '',
                'cuenta' => $garantia->cuenta ?? '',
                'numero_cuenta' => $garantia->numero_cuenta ?? '',
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
            'CÓDIGO CONTRATO',
            'GARANTIA',
            'PAGADO',
            'SALDO',
            'FECHA DE PAGO',
            'FECHA DEPOSITO',
            'CUENTA',
            'NRO. CUENTA',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Garantias';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE GARANTIAS";
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
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CÓDIGO CONTRATO
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna GARANTIA
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna PAGADO
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna SALDO
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA DE PAGO
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna FECHA DEPOSITO
                    'I' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CUENTA
                    'J' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NRO. CUENTA
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
