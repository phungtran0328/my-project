<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class RevenueChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->options([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => 'rgb(0,98,65)',
                    'boxWidth' => 20,
                ],
            ],
            'title' => [
                'display' => true,
            ],
            'elements' => [
                'rectangle' => [
//                    'backgroundColor' => 'rgb(66,110,180)',
                    'borderWidth' => 10,
                    'borderColor' => 'rgb(112,112,112)',
                ]
            ],
        ]);
    }
}
