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

class ReporteContratoExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $aeropuerto;
    protected $tipoSolicitante;
    protected $cliente;
    protected $ciNit;
    protected $estado;

    // Constructor para recibir parámetros
    public function __construct($aeropuerto, $tipoSolicitante, $cliente, $ciNit, $estado)
    {
        //dd($aeropuerto.' '.$tipoSolicitante.' '.$cliente.' '.$ciNit.' '.$estado);
        $this->aeropuerto = $aeropuerto;
        $this->tipoSolicitante = $tipoSolicitante;
        $this->cliente = $cliente;
        $this->ciNit = $ciNit;
        $this->estado = $estado;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //$contratos = Reporte::reporteContrato($this->aeropuerto, $this->tipoSolicitante, $this->cliente, $this->ciNit, $this->estado);
        //return collect($contratos);

        $contratos = Reporte::reporteContrato($this->aeropuerto, $this->tipoSolicitante, $this->cliente, $this->ciNit, $this->estado);
    
        // Convertir el array en una colección
        $contratos = collect($contratos);

        // Usar map para agregar el atributo ci_nit
        return $contratos->map(function ($contrato) {
            return [
                'cod_aeropuerto' => $contrato->cod_aeropuerto ?? '',
                'cliente' => $contrato->cliente_nombre ?? '',
                'representante' => $contrato->representante ?? '',
                'tipo_solicitante' => $contrato->desc_tipo_solicitante ?? '',
                'ci_nit' => $contrato->ci ?? $contrato->nit ?? '',
                'domicilio_legal' => $contrato->domicilio_legal ?? '',
                'telefono' => $contrato->telefono_celular ?? '',
                'correo' => $contrato->correo ?? '',
                'estado' => $contrato->desc_estado ?? '',
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
            'REPRESENTANTE',
            'TIPO SOLICITANTE',
            'CI/NIT',
            'DOMICILIO LEGAL',
            'TELÉFONO/CELULAR',
            'CORREO',
            'ESTADO',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Reporte de Contratos';
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
                $title = "NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS\nSISTEMA ALQUILERES\nREPORTE DE CONTRATOS";
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
                    'C' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna REPRESENTANTE
                    'D' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TIPO SOLICITANTE
                    'E' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna NIT/CI
                    'F' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna DOMICILIO LEGAL
                    'G' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna TELÉFONO/CELULAR
                    'H' => Alignment::HORIZONTAL_CENTER, // Alinear al centro para la columna CORREO
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
