<?php

namespace App\Filament\Widgets;

use Illuminate\Contracts\View\View;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TestChart extends ApexChartWidget
{
    /**
     * Chart Id
     */
    //protected static ?string $chartId = 'orderStatusChart';
    /**
     * Widget Title
     */
    protected static ?string $heading = 'ICV';

    /**
     * Sort
     */
    protected static ?int $sort = 3;

    /**
     * Widget content height
     */
    protected static ?int $contentHeight = 450;

    /**
     * Widget Footer
     */
    protected function getFooter(): string | View
    {
        $data = [
            'new' => 230,
            'delivered' => 890,
            'cancelled' => 54,
        ];

        #return view('charts.icv-status.footer', ['data' => $data]);
        return 'None';
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     */
    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'radialBar',
                'height' => 400,
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'series' => [60.4],
            'plotOptions' => [
                'radialBar' => [
                    'startAngle' => -90,
                    'endAngle' => 90,
                    'hollow' => [
                        'size' => '60%',
                        'background' => 'transparent',
                    ],
                    'track' => [
                        'background' => 'transparent',
                        'strokeWidth' => '100%',
                    ],
                    'dataLabels' => [
                        'show' => true,
                        'name' => [
                            'show' => true,
                            'offsetY' => -10,
                            'fontWeight' => 600,
                            'fontFamily' => 'inherit',
                        ],
                        'value' => [
                            'show' => true,
                            'fontWeight' => 600,
                            'fontSize' => '24px',
                            'fontFamily' => 'inherit',
                        ],
                    ],

                ],
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shade' => 'dark',
                    'type' => 'horizontal',
                    'shadeIntensity' => 0.8,
                    'gradientToColors' => ['#ff0e0e'],
                    'inverseColors' => false,
                    'opacityFrom' => 1,
                    'opacityTo' => 0.6,
                    'stops' => [0,50],
                ],
            ],
            'stroke' => [
                'dashArray' => 10,
            ],
            'labels' => ['%'],
            'colors' => ['#ff0e0e'],
            //16a34a
            
            

        ];
    }
}