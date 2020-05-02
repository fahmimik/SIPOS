@extends('layouts.base')

@section('title', 'Daftar KMS')

@section('css')
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendors/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar KMS</h2>
                    <ul class="nav navbar-left panel_toolbox">
                        <li>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <select id="select-age" class="select2_single form-control">
                                        {{-- foreach age in here --}}
                                        <option value="-1">Pilih Umur</option>
                                        @foreach($list_of_ages as $index => $age)
                                            {{-- Value + 1 because start from 0 --}}
                                            <option value="{{ $index + 1 }}">{{ $age }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <select id="select-month" class="select2_single form-control">
                                        {{-- foreach month in here --}}
                                        <option value="-1">Pilih Bulan</option>
                                        @foreach($list_of_months as $index => $month)
                                            {{-- Value + 1 because start from 0 --}}
                                            <option value="{{ $index + 1 }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <select id="select-year" class="select2_single form-control">
                                        <option value="-1">Pilih Tahun</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            <button type="button" class="btn btn-success"
                                    onclick="window.location='{{ route('dashboard.activity.create') }}';">Tambah Data
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
                    <table class="table table-striped table-bordered" id="activity-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal KMS</th>
                            <th>Berat</th>
                            <th>Panjang</th>
                            <th>Imunisasi</th>
                            <th>Keterangan</th>
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
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        function destroy(url) {
            $('#delete-form').attr('action', url).submit();
            event.stopPropagation();
        }

        var datatable = $('#activity-table').DataTable({
            ajax: {
                url: '{{ route('ajax.activities') }}',
                data: (d) => {
                    // passing data ke ajax
                    d.age = $('#select-age').val(); // ambil value dari select age
                    d.year = $('#select-year').val(); // ambil value dari select year
                    d.month = $('#select-month').val(); // ambil value dari select month
                    console.log(d);
                }
            },
            // dari yang udah digenerate di backend, pasang disini berururtan sesuai dari table
            // parameternya data dan name dan valuenya sama tapi ada beberapa berbeda
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'children.name', name: 'children.name'}, // buat relasi dari activity ke children lalu ambil name, cek http://localhost:8000/ajax/dashboard/activities?age=-1&year=-1&month=-1
                {data: '_date', name: 'created_at'}, // disini beda, karena _date buat data yang ditampilkan dan created at buat data yang diolah
                {data: 'weight', name: 'weight'},
                {data: 'height', name: 'height'},
                {data: '_immunization', name: '_immunization'}, // custom kolom immunization
                {data: 'notes', name: 'notes'},
                {data: '_action', name: '_action'}, // custom kolom action
            ]
        });

        $('#select-age').change(function(){ // buat trigger jika select umur berubah, maka datatable ngeload ulang
            datatable.ajax.reload();
        });

        $('#select-month').change(function(){ // buat trigger jika select month berubah, maka datatable ngeload ulang
            datatable.ajax.reload();
        });

        $('#select-year').change(function(){ // buat trigger jika select year berubah, maka datatable ngeload ulang
            datatable.ajax.reload();
        });
    </script>
@endsection
