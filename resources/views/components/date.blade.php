<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{ $title }}
        <span class="required"></span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <fieldset>
            <div class="control-group">
                <div class="controls">
                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left"
                               id="single_cal2" placeholder="{{ $title }}"
                               aria-describedby="inputSuccess2Status2"
                               name="{{ $name }}"
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