@extends('layouts.base')

@section('title', 'Layanan Ibu Hamil')

@section('css')
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Ibu</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button type="button" class="btn btn-success"
                                    onclick="window.location='{{ route('dashboard.pregnant.create') }}';">Tambah Data Ibu Hamil
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
                    <table class="table table-striped table-bordered" id="mother-table">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Ibu</th>
                          <th>Tanggal Kunjungan</th>
                          <th>Nomor Kehamilan</th>
                          <th>LILA (cm)</th>
                          <th>Berat Ibu (Kg)</th>
                          <th>Umur Kehamilan (Dalam Minggu)</th>
                          <th>Pil Darah</th>
                          <th>Imunisasi</th>
                          <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($pregnants as $index => $pregnant)
                              <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>{{ $pregnant->parent->name }}</td>
                                  <td>{{ $pregnant->created_at->format('d/m/Y') }}</td>
                                  <td>{{ $pregnant->number_of_pregnant }}</td>
                                  <td>{{ $pregnant->lila }}</td>
                                  <td>{{ $pregnant->weight }}</td>
                                  <td>{{ $pregnant->pregnant_age }}</td>
                                  <td>{{ $pregnant->blood_pill }}</td>
                                  <td>{{ $pregnant->tetanus_immunization }}</td>
                                  <td>
                                      <!-- <a href="{{ route('dashboard.pregnant.show', $pregnant) }}" class="btn btn-primary"><i class="fa fa-info"></i></a> -->
                                      <a class="btn btn-success" href="{{ route('dashboard.pregnant.edit', $pregnant) }}"><i class="fa fa-edit"></i></a>
                                      <!-- <a class="btn btn-danger" onclick="destroy('{{ route("dashboard.pregnant.destroy", $pregnant) }}')"><i class="fa fa-trash"></i></a> -->
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

        $('#mother-table').DataTable();
    </script>
@endsection
