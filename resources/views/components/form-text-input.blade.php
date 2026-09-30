@props(['label', 'type' => 'text', 'name'])

<div>
    <label for="{{$name}}"> {{ $label }} </label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" value="{{old($name)}}" {{ $attributes }}>
    @error( $name )
    <p class="text-red-600 text-sm"> {{ $message }} </p>
    @enderror
</div>