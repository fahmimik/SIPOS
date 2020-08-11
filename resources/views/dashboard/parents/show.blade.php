@extends('layouts.base')

@section('title', 'Data KMS')

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Pasangan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>

                        </li>
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
                                <td>{{ $family->father->name }}</td>
                            </tr>
                            <tr>
                                <td>NIK : </td>
                                <td>{{ $family->father->nik }}</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir : </td>
                                <td>{{ $family->father->birth_place }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir : </td>
                                <td>{{ $family->father->birth_date->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Agama : </td>
                                <td>{{ $family->father->religion->name }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan : </td>
                                <td>{{ $family->father->job }}</td>
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
                                <td>{{ $family->mother->name }}</td>
                            </tr>
                            <tr>
                                <td>NIK : </td>
                                <td>{{ $family->mother->nik }}</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir : </td>
                                <td>{{ $family->mother->birth_place }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir : </td>
                                <td>{{ $family->mother->birth_date->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Agama : </td>
                                <td>{{ $family->mother->religion->name }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan : </td>
                                <td>{{ $family->mother->job }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr style="color: #000000; width: 100%; border-width: 3px; background-color: #000000">

                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Tanggal Menikah : </td>
                            <td>{{ $family->married_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Alamat : </td>
                            <td>{{ $family->address }}</td>
                        </tr>
                        <tr>
                            <td>No KK : </td>
                            <td>{{ $family->no_kk }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <hr style="color: #000000; width: 100%; border-width: 3px; background-color: #000000">

                    <h2 class="text-center" style="font-size: 30px">Anak</h2>

                    <table id="anak-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>

                            <th>Agama</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($family->childrens as $index => $children)
                            <tr class="clickable-row" data-href="{{ route('dashboard.children.show', ["children" => $children->id]) }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $children->name }}</td>
                                <td>{{ $children->birth_place }}</td>
                                <td>{{ $children->birth_date->format('d/m/Y') }}</td>

                                <td>{{ $children->religion->name }}</td>
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
@endsection
