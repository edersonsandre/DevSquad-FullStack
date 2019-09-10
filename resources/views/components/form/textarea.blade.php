<?php
$rows = @$rows ?? 6;
?>
<div class="form-group ">
    @if(!empty($label))
        <label for="form-textarea-{!! $name !!}" class="control-label">{!! $label !!}</label>
    @endif
    <textarea id="form-textarea-{!! $name !!}" name="{!! $name !!}" rows="{!! $rows !!}" class="form-control col-md-12">{!! ($model->$name) ?? null !!}</textarea>
</div>
