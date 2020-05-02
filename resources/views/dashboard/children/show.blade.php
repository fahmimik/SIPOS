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
                    <table>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
