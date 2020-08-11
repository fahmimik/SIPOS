@extends('layouts.base')

@section('title', 'Home')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row top_tiles">
                <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-child"></i></div>
                        <div class="count">{{ $total->children }}</div>
                        <h3>Jumlah Anak</h3>
                        <!-- <p>pada seluruh kabupaten Probolinggo</p> -->
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-home"></i></div>
                        <div class="count">{{ $total->family }}</div>
                        <h3>Jumlah keluarga</h3>
                        <!-- <p>yang terdaftar pada posyandu</p> -->
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count">{{ $total->user }}</div>
                        <h3>Jumlah User</h3>
                        <!-- <p>pada posyandu di kabupaten Probolinggo</p> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Grafik kehadiran posyandu selama 1 tahun</h2>
                    {{--<div class="filter">--}}
                        {{--<div class="reportrange">--}}
                            {{--<select name="year" id="year-select">--}}
                                {{--<option value="">asd</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="">
                        {!! $attemp_chart->container() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('js')
    {!! $attemp_chart->script() !!}
@endsection
