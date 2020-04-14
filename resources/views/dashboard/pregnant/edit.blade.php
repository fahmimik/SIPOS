@extends('layouts.base')

@section('title', 'Edit Data Layanan Ibu Hamil')

@section('css')

@endsection

@section('content')
    <div class="row">
        <form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="post"
              action="{{ route('dashboard.pregnant.store', $pregnant) }}">
            @csrf
            @method('PATCH')
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>EDit Data Ibu Hamil</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Ibu Hamil</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="nama_ibu" required>
                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal Kunjungan
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="tanggal-kunjungan" placeholder=""
                                                       aria-describedby="inputSuccess2Status2" name="tanggal_kunjungan" value="{{ $pregnant->visit_at->format('d/m/Y') }}">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kehamilan Ke -
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name" value="{{ $pregnant->number_of_pregnant }}" required="required"
                                       class="form-control col-md-7 col-xs-12" name="kehamilan_ke">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">LILA (cm)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name" value="{{ $pregnant->lila }}" required="required"
                                       class="form-control col-md-7 col-xs-12" name="lila">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Berat Badan Ibu
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name" value="{{$pregnant->weight}}" required="required"
                                       class="form-control col-md-7 col-xs-12" name="berat">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Umur Kehamilan (Dalam Minggu)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name" value="{{ $pregnant->pregnant_age }}" required="required"
                                       class="form-control col-md-7 col-xs-12" name="umur_kehamilan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Pil Penambah Darah (isi 0 Bila Tidak Ada)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="last-name"
                                       class="form-control col-md-7 col-xs-12" name="pil_darah" value="{{ $pregnant->blood_pill }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="imunisasi_tt" class="control-label col-md-3 col-sm-3 col-xs-12">Imunisasi Tetanus</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="imunisasi_tt" class="form-control" name="imunisasi">
                                        <option value="">-</option>
                                        <option value="T1">T1</option>
                                        <option value="T2">T2</option>
                                        <option value="T3">T3</option>
                                        <option value="T4">T4</option>
                                        <option value="T5">T5</option>
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"
                                        onclick="window.location = '{{ route('dashboard.pregnant.index') }}'">Cancel
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
            $('#tanggal-kunjungan').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@endsection
