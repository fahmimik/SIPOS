<div class="form-group" id="{{ isset($div_id) ? $div_id : '' }}" {{ isset($hide) ? 'hidden' : '' }}>
    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ $title }}</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="form-control" name="{{ $name }}" required id="{{ isset($id) ? $id : '' }}" {{ isset($elements) ? $elements : '' }}>
            {{ $data }}
        </select>
    </div>
</div>