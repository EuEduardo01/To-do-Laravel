<div class="input-area">
    <label for="{{$name}}">
        {{$label ?? ''}}
    </label>
    <select name="{{$name}}" id="{{$name}}" class="{{$class ?? ''}}"
        {{empty($required) ? '' : 'required'}}
    />
        <option selected disabled value="">Selecione uma opção</option>
        {{$slot}}
    </select>
</div>