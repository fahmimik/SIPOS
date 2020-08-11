@extends('layouts.base')

@section('title', 'Edit Pasangan')

@section('css')
    <link href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="post"
              action="{{ route('dashboard.family.update', $family) }}">
              @csrf
              @method('PATCH')
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Data Suami</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Suami <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required" value="{{ $family->father->name }}"
                                       class="form-control col-md-7 col-xs-12" name="nama_suami">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NIK Suami <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required" value="{{ $family->father->nik }}"
                                       class="form-control col-md-7 col-xs-12" name="nik_suami"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tempat Lahir Suami
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required" value="{{ $family->father->birth_place }}"
                                       class="form-control col-md-7 col-xs-12" name="tempat_lahir_suami"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal Lahir Suami
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="tanggal-lahir-suami" placeholder=""
                                                       aria-describedby="inputSuccess2Status2"
                                                       name="tanggal_lahir_suami" value="{{ $family->father->birth_date->format('d/m/Y') }}"
                                                >
                                                <span class="fa fa-calendar-o form-control-feedback left"
                                                      aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="agama_suami" required >
                                    @foreach($agamas as $agama)
                                        <option value="{{ $agama->id }}"{{ $family->father->religion_id == $agama->id ? 'selected' : '' }}>{{ $agama->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pekerjaan Suami
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required" value="{{ $family->father->job }}"
                                       class="form-control col-md-7 col-xs-12" name="pekerjaan_suami">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Istri</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Istri <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required" value="{{ $family->mother->name }}"
                                       class="form-control col-md-7 col-xs-12" name="nama_istri">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NIK Istri <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required" value="{{ $family->mother->nik }}"
                                       class="form-control col-md-7 col-xs-12" name="nik_istri">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tempat Lahir Istri
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required" value="{{ $family->mother->birth_place }}"
                                       class="form-control col-md-7 col-xs-12" name="tempat_lahir_istri">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal Lahir Istri
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="tanggal-lahir-istri" placeholder=""
                                                       aria-describedby="inputSuccess2Status2"
                                                       name="tanggal_lahir_istri" value="{{ $family->mother->birth_date->format('d/m/Y') }}" >
                                                <span class="fa fa-calendar-o form-control-feedback left"
                                                      aria-hidden="true"></span>
                                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="agama_istri" required>
                                    @foreach($agamas as $agama)
                                        <option value="{{ $agama->id }}"{{ $family->mother->religion_id == $agama->id ? 'selected' : '' }}>{{ $agama->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pekerjaan Istri
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required"
                                       class="form-control col-md-7 col-xs-12" name="pekerjaan_istri" value="{{ $family->mother->job }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nomor KK <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required" value="{{ $family->no_kk }}"
                                       class="form-control col-md-7 col-xs-12" name="no_kk">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Alamat
                                Pasangan<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" required="required" value="{{ $family->address }}"
                                       class="form-control col-md-7 col-xs-12" name="alamat_pasangan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal Menikah
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="tanggal-menikah" placeholder=""
                                                       aria-describedby="inputSuccess2Status2" name="tanggal_menikah" value="{{ $family->married_at->format('d/m/Y') }}">
                                                <span class="fa fa-calendar-o form-control-feedback left"
                                                      aria-hidden="true"></span>
                                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"
                                        onclick="window.location = '{{ route('dashboard.family.index') }}'">Cancel
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
            $('#tanggal-lahir-suami').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#tanggal-lahir-istri').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#tanggal-menikah').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@endsection
