<!-- resources/views/components/select-dropdown.blade.php -->

@props(['options' => []])

<select {{ $attributes }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>