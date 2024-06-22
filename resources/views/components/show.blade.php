<!-- resources/views/components/show.blade.php -->
@props(['default' => false])

<div x-data="{ show: @json($default) }">
    <div @click="show = !show">
        {{ $trigger }}
    </div>
    <div x-show="show" x-transition>
        {{ $slot }}
    </div>
</div>
