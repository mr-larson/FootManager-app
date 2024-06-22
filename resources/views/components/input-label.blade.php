@props(['value'])

<label {{ $attributes->merge(['class' => 'text-slate-500 font-bold w-1/3 text-right mb-1 md:mb-0 pr-4']) }}>
    {{ $value ?? $slot }}
</label>
