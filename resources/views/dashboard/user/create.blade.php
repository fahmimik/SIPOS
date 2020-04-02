@extends('layouts.base')

@section('title', 'Tambah User')

@section('css')

@endsection

@section('content')
    <div class="row">
        <form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="post"
              action="{{ route('dashboard.users.store') }}">
            @csrf
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah User</h2>
                        <ul class="nav navbar-right panel_toolbox">

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        @component('components.text')
                            @slot('title', 'Nama')
                            @slot('name', 'name')
                        @endcomponent

                        @component('components.text')
                            @slot('type', 'email')
                            @slot('title', 'Email')
                            @slot('name', 'email')
                        @endcomponent

                        @component('components.dropbox')
                            @slot('title', 'Peran')
                            @slot('name', 'peran')
                            @slot('id', 'peran-drop')
                            @slot('data')
                                <option>Pilih Peran</option>
                                <option value="bidan">Bidan</option>
                                <option value="kader">Kader</option>
                            @endslot
                        @endcomponent

                        @component('components.text')
                            @slot('type', 'password')
                            @slot('title', 'Password')
                            @slot('name', 'password')
                        @endcomponent

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"
                                        onclick="window.location = '{{ route('dashboard.users.index') }}'">Cancel
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
    <script>

    </script>
@endsection
