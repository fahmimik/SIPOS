<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{ $title }}
        <span class="required"></span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="{{ isset($type) ? $type : 'text' }}" id="{{ isset($id) ? $id : '' }}"
               class="form-control col-md-7 col-xs-12" name="{{ $name }}" {{ isset($elements) ? $elements : '' }} value="{{ isset($value) ? $value : '' }}">
    </div>
</div>