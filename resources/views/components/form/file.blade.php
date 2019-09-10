<div class="form-group ">
    @if(!empty($label))
        <label for="form-input-{!! $name !!}" class="control-label">{!! $label !!}</label>
    @endif
    <input id="form-input-{!! $name !!}" type="file" name="{!! $name !!}" class="form-control col-md-12"/>
</div>
