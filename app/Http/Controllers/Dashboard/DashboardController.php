<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Children;
use App\Family;
use App\User;
use App\Activity;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
      $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
      $total = new \stdClass();
      $total->children = Children::count();
      $total->family = Family::count();
      $total->user = User::count();

      $chart_data = [];
      foreach ($months as $month) {
        $temp = Activity::whereYear('created_at', date('Y'))
        ->whereMonth('created_at', $month)
        ->count();
    array_push($chart_data, $temp);
      }

              $attemp_chart = new DashboardChart();
              $attemp_chart->labels($months);
              $attemp_chart->dataset('Kehadiran', 'bar', $chart_data)->backgroundColor('rgb(141, 204, 150, 0.3)');
              $attemp_chart->options([
                  'scales' => [
                      'xAxes' => [
                          [
                              'scaleLabel' => [
                                  'display' => true,
                                  'labelString' => 'Bulan'
                              ],
                          ]
                      ],
                      'yAxes' => [
                          [
                              'scaleLabel' => [
                                  'display' => true,
                                  'labelString' => 'Jumlah anak'
                              ],
                              'ticks' => [
                                  'beginAtZero' => true,
                                  'stepSize' => 5
                              ],
                          ],
                      ],
                  ],
              ]);

              // dd($attemp_chart);
        return view('dashboard.index', compact('total', 'attemp_chart'));
    }
}
