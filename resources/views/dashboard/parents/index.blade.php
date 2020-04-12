@extends('layouts.base')

@section('title', 'Daftar Pasangan')

@section('css')
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Pasangan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button type="button" class="btn btn-success"
                                    onclick="window.location='{{ route('dashboard.family.create') }}';">Tambah Pasangan
                            </button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content table-responsive">
                    <p class="text-muted font-13 m-b-30">
                        {{--Text--}}
                    </p>
                    <form action="" id="delete-form" method="post">
                        @method('DELETE')
                        @csrf
                    </form>
                    <table class="table table-striped table-bordered" id="family-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No KK</th>
                            <th>Nama Suami</th>
                            <th>Nama Istri</th>
                            <th>Tangagl Menikah</th>
                            <th>Alamat</th>
                            <th>Jumlah Anak</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($families as $index => $family)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $family->no_kk }}</td>
                                <td>{{ $family->father->name }}</td>
                                <td>{{ $family->mother->name }}</td>
                                <td>{{ $family->married_at }}</td>
                                <td>{{ $family->address }}</td>
                                <td>{{ $family->childrens->count() }}</td>
                                <td>
                                    <a href="{{ route('dashboard.family.show', $family) }}" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                    <a class="btn btn-success" href="{{ route('dashboard.family.edit', $family) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger" onclick="destroy('{{ route("dashboard.family.destroy", $family) }}')"><i class="fa fa-trash"></i></a>
                                </td>
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
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script>
        function destroy(url) {
            $('#delete-form').attr('action', url).submit();
            event.stopPropagation();
        }

        $('#family-table').DataTable();
    </script>
@endsection
