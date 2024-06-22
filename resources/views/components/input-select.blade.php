@props(['options' => [], 'placeholder' => 'Select an option', 'value' => null, 'id' => null, 'disabled' => false])

<select {{ $attributes->merge(['class' => 'text-gray-900 bg-stone-50 border border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm', 'id' => $id, 'wire:model' => $value]) }}>
    <option value="">{{ $placeholder }}</option>
    @foreach($options as $key => $option)
        <option value="{{ $key }}">{{ $option }}</option>
    @endforeach
</select>
