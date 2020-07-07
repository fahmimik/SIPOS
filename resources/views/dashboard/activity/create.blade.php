@extends('layouts.base')

@section('title', 'Tambah Data KMS')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/skins/flat/green.css') }}">
@endsection

@section('content')
    <div class="row">
        <form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="post"
              action="{{ route('dashboard.activity.store') }}">
            @csrf
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah Data KMS</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Anak</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="child" required>
                                    @foreach($childs as $child)
                                        <option value="{{ $child->id }}" {{ old('child') == $child->id ? 'selected' : '' }}>{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal KMS
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="tanggal-kegiatan" placeholder="" value="{{ now()->format('d/m/Y') }}"
                                                       aria-describedby="inputSuccess2Status2" name="activity_date">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Umur Anak (Bulan)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" required="required" value="{{ old('age') }}"
                                       class="form-control col-md-7 col-xs-12" name="age" min="0" max="60" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat (kg)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" required="required" value="{{ old('weight') }}"  autocomplete="off"
                                       class="form-control col-md-7 col-xs-12" name="weight" step="0.1" min="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Panjang (cm)
                                <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" required="required" value="{{ old('height') }}"  autocomplete="off"
                                       class="form-control col-md-7 col-xs-12" name="height" step="0.1" min="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 ">Keterangan</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="note" class="resizable_textarea form-control" placeholder="Beri catatan tentang pemeriksaan" style="margin-top: 0px; margin-bottom: 0px; height: 187px;">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Asi</label>
                            {{-- show Imunizations data here --}}
                            <div class="col-md-9 col-sm-9 ">
                                <div class="checkbox">
                                    @foreach($breast_milks as $asi)
                                        <label>
                                            <input class="flat" type="checkbox" name="breast_milks[]" value="{{ $asi->id }}"> {{ $asi->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Imunisasi</label>
                            {{-- show Imunizations data here --}}
                            <div class="col-md-9 col-sm-9 ">
                                @foreach($immunizations as $immunization)
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat" type="checkbox" name="immunizations[]"
                                                   value="{{ $immunization->id }}"> {{ $immunization->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group" id="vitamin-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Vitamin A
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="vitamin_a" value="0" checked>
                                        Tidak Diberi
                                    </label>
                                    <label>
                                        <input type="radio" class="flat" name="vitamin_a" value="1">
                                        Diberi
                                    </label>
                                </div>
                            </div>
                        </div>

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
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Hide vitamin form
            $('#vitamin-group').hide();

            $('#tanggal-kegiatan').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            // Trigger jika dropdown bulan berganti februari / agustus makan vitamin form show
            $('#select-month').change(function(){
                if($(this).val() == 2 || $(this).val() == 8) { // jika nilai bulan 2 atau 8 (februari atau agustus)
                    // show vitamin group
                    $('#vitamin-group').show();
                } else {
                    // hide vitamin group
                    $('#vitamin-group').hide();
                }
            }).change();
        });
    </script>
@endsection
