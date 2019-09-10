@php
    $value = !empty($model->$name) || @$model->$name > -1 ?  $model->$name:  null;
@endphp
<div class="form-group ">
    @if(!empty($label))
        <label for="form-select-{!! $name !!}" class="control-label">{!! $label !!}</label>
    @endif
    <select id="form-select-{!! $name !!}" name="{!! $name !!}" class="form-control col-md-12">
        @if(!empty($options) && is_array($options))
            <option value="" {!! is_null($value) ? '1' : null !!}>...</option>
            @foreach($options AS $key => $label)
                @php
                    $selected = (!is_null($value) && $value == $key) ? " selected='selected' " : null;
                @endphp
                <option value="{!! $key !!}" {!! $selected !!}>{!! $label !!}</option>
            @endforeach
        @endif
    </select>
</div>
