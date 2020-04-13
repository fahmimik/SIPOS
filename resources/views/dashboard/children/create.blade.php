@extends('layouts.base')

@section('title', 'Tambah Data Anak')

@section('css')

@endsection

@section('content')
    <div class="row">
        <form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="post"
              action="{{ route('dashboard.children.store') }}">
            @csrf
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah Data Anak</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pasangan</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="pasangan" required>
                                    @foreach($families as $family)
                                        <option value="{{ $family->id }}">{{ $family->mother->name }}
                                            - {{ $family->father->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nama Anak
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required"
                                       class="form-control col-md-7 col-xs-12" name="nama">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tempat Lahir
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required"
                                       class="form-control col-md-7 col-xs-12" name="tempat_lahir">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal Lahir
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="tanggal-lahir" placeholder="First Name"
                                                       aria-describedby="inputSuccess2Status2" name="tanggal_lahir">
                                                <span class="fa fa-calendar-o form-control-feedback left"
                                                      aria-hidden="true"></span>
                                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="agama" required>
                                    @foreach($agamas as $agama)
                                        <option value="{{ $agama->id }}">{{ $agama->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Jenis Kelamin
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" checked name="jenis_kelamin" value="1">
                                        Laki-Laki
                                    </label>
                                    <label>
                                        <input type="radio" class="flat" name="jenis_kelamin" value="2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Berat Lahir (kg)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name" required="required"
                                       class="form-control col-md-7 col-xs-12" name="berat_lahir" step="0.1" min="0">
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Panjang Lahir (cm)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name" required="required"
                                       class="form-control col-md-7 col-xs-12" name="panjang_lahir" step="0.1" min="0">
                            </div>
                        </div> -->


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"
                                        onclick="window.location = '{{ route('dashboard.children.index') }}'">Cancel
                                </button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendors/DateJS/build/date.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#tanggal-lahir').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@endsection
