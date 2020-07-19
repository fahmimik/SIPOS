@extends('layouts.base')

@section('title', 'Daftar Anak')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Anak</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Nama : </td>
                            <td>{{ $children->name }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin : </td>
                            <td>{{ $children->gender_name }}</td> {{-- App/Children Line 61 --}}
                        </tr>
                        <tr>
                            <td>Agama : </td>
                            <td>{{ $children->religion->name }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir : </td>
                            <td>{{ $children->birth_place }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir : </td>
                            <td>{{ $children->birth_date->format('d/m/Y') }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <hr>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Orang Tua</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-6">
                        <h4><b>Data Ayah</b></h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Nama : </td>
                                <td>{{ $father->name }}</td>
                            </tr>
                            <tr>
                                <td>NIK : </td>
                                <td>{{ $father->nik }}</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir : </td>
                                <td>{{ $father->birth_place }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir : </td>
                                <td>{{ $father->birth_date->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Agama : </td>
                                <td>{{ $father->religion->name }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan : </td>
                                <td>{{ $father->job }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h4><b>Data Ibu</b></h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Nama : </td>
                                <td>{{ $mother->name }}</td>
                            </tr>
                            <tr>
                                <td>NIK : </td>
                                <td>{{ $mother->nik }}</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir : </td>
                                <td>{{ $mother->birth_place }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir : </td>
                                <td>{{ $mother->birth_date->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Agama : </td>
                                <td>{{ $mother->religion->name }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan : </td>
                                <td>{{ $mother->job }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Grafik KMS</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div id="chart_div"></div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Riwayat KMS</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Umur</th>
                            <th>Berat</th>
                            <th>Panjang</th>
                            <th>Asi</th>
                            <th>Imunisasi</th>
                            <th>Vit A</th>
                            <th>Catatan</th>
                            <th>BB/U</th>
                            <th>TB/U</th>
                            <th>BB/TB</th>
                            <th>IMT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $index => $activity)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $activity->created_at->format('d/m/Y') }}</td>
                                <td>{{ $activity->age }}</td>
                                <td>{{ $activity->weight }}</td>
                                <td>{{ $activity->height }}</td>
                                <td>{{ implode(', ', $activity->breastMilks->pluck('name')->toArray()) }}</td>
                                <td>{{ implode(', ', $activity->immunizations->pluck('name')->toArray()) }}</td>
                                <td>{{ $activity->vitamin_a == 1 ? 'Diberi' : '-' }}</td>
                                <td>{{ $activity->notes }}</td>
                                <td class="{{ $activity->status_bb_per_u['type'] }}">{{ $activity->status_bb_per_u['title'] }}</td>
                                <td class="{{ $activity->status_tb_per_u['type'] }}">{{ $activity->status_tb_per_u['title'] }}</td>
                                <td class="{{ $activity->status_bb_per_tb['type'] }}">{{ $activity->status_bb_per_tb['title'] }}</td>
                                <td class="{{ $activity->status_imt['type'] }}">{{ $activity->status_imt['title'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script>
        function init() {
            google.load("visualization", "1.1", {
                packages: ["corechart"],
                callback: 'drawChart'
            });
        }

        function drawChart() {
            var data = google.visualization.arrayToDataTable({!! json_encode($chart_data) !!});

            var options = {
                title: 'Grafik Kartu Menuju Sehat',
                hAxis: {title: 'Umur (bulan)'},
                vAxis: {title: 'Bobot (kg)'},
                interpolateNulls: true,
                height: 400,
                series: {
                    0: {areaOpacity: 1},
                    1: {areaOpacity: 1},
                    2: {areaOpacity: 1},
                    3: {areaOpacity: 1},
                    4: {areaOpacity: 1},
                    5: {areaOpacity: 1},
                    6: {areaOpacity: 1},
                    7: {areaOpacity: 1, type: 'line'},
                },
                colors: ['#ffff00', '#5FE118', '#22b72a', '#22b72a', '#5FE118', '#ffff00', '#ff0000', '#000']
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        $(document).ready(function(){
            init();
        })
    </script>
@endsection
