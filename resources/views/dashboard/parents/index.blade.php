@extends('layouts.base')

@section('title', 'Daftar Pasangan')

@section('css')
    <style>
    </style>
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
                                    onclick="window.location='{{ route('dashboard.parents.create') }}';">Tambah Pasangan
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
                    <table id="pasangan-table" class="table table-striped table-bordered">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function destroy(url) {
            $('#delete-form').attr('action', url).submit();
            event.stopPropagation();
        }
    </script>
@endsection