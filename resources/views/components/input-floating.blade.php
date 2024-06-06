<div class="container-input">
  <div class="material-textfield">
    @switch(strtolower($type))
    @case('select')
        <select id="{{ $id }}" name="{{ $name }}">
          @foreach($options as $key => $value)
          <option value="{{ $value->value }}">{{ $value->label }}</option>
          @endforeach
        </select>
        <label for="{{ $id }}">{{ $label }}</label>
        @break
    @case('select-multiple')
        <select id="{{ $id }}" name="{{ $name }}" class="select2" multiple>
          @foreach($options as $key => $value)
          <option value="{{ $value->value }}">{{ $value->label }}</option>
          @endforeach
        </select>
        <label for="{{ $id }}" id="label-multiple">{{ $label }}</label>
        @break
 
    @case('textarea')
        <textarea rows="{{ $rows }}" cols="{{ $cols }}" id="{{ $id }}" name="{{ $name }}" placeholder="">
        </textarea>
        <label for="{{ $id }}">{{ $label }}</label>
        @break

    @case('password')
        <i class="ti ti-eye-off icon-password"></i>
        <input placeholder="" type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" class="input-password" />
        <label for="{{ $id }}">{{ $label }}</label>
        @break
    @default
        <input placeholder="" type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" />
        <label for="{{ $id }}">{{ $label }}</label>
    @endswitch
  </div>
</div>