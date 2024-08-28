<div class="input-area">
    <label for="{{$name}}">
        {{$label ?? ''}}
    </label>
    <input 
     type="checkbox" 
     id="{{$name}}"
     name="{{$name}}" 
    {{empty($required) ? '' : 'required'}} 
     value="1"
     {{$checked ? 'checked' : ''}}
    />
</div>