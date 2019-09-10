@php
    $class_form = $class ?? "";
@endphp
<div class="form-group ">
    @if(!empty($label))
        <label for="form-input-{!! $name !!}" class="control-label">{!! $label !!}</label>
    @endif
    <input id="form-input-{!! $name !!}" name="{!! $name !!}" class="form-control col-md-12 {!! $class_form !!}"
           value="{!! !empty($model->$name) ? $model->$name : null !!}"/>
</div>
