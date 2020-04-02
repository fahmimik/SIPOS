<div class="form-group">
    <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ $title }}
    </label>

    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="checkbox">
            @foreach($kontrasepsis as $kontrasepsi)
                <label>
                    <input type="checkbox" class="flat" name="penggantian_kontrasepsi[{{ $kontrasepsi->id }}]"> {{ $kontrasepsi->nama_kontrasepsi }}
                </label>
            @endforeach
        </div>
    </div>
</div>