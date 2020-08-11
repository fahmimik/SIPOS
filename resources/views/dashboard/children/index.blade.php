@extends('layouts.base')

@section('title', 'Daftar Anak')

@section('css')
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Anak</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button type="button" class="btn btn-success"
                                    onclick="window.location='{{ route('dashboard.children.create') }}';">Tambah Anak
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
                    <table class="table table-striped table-bordered" id="children-table">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Anak</th>
                          <th>Nama Ibu</th>
                          <th>Nama Ayah</th>
                          <th>Tempat Lahir</th>
                          <th>Tanggal Lahir</th>
                          <th>Agama</th>
                          <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($childrens as $index => $children)
                              <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>{{ $children->name }}</td>
                                  <td>{{ $children->family->mother->name }}</td>
                                  <td>{{ $children->family->father->name }}</td>
                                  <td>{{ $children->birth_place }}</td>
                                  <td>{{ $children->birth_date->format('d/m/Y') }}</td>
                                  <td>{{ $children->religion->name }}</td>
                                  <td>
                                      <a href="{{ route('dashboard.children.show', $children) }}" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                      <a class="btn btn-success" href="{{ route('dashboard.children.edit', $children) }}"><i class="fa fa-edit"></i></a>
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

        $('#children-table').DataTable();
    </script>
@endsection
