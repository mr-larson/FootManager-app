<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Style Guide') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Danger Button</h3>
            <x-danger-button>{{ __('Delete') }}</x-danger-button>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Input Error</h3>
            <x-input-error class="mt-2" :messages="['This is an error message.']" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Input Label</h3>
            <x-input-label for="name" :value="__('Name')" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Primary Button</h3>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Secondary Button</h3>
            <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Text Input</h3>
            <x-input-text wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Enter text here" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">input-textarea</h3>
            <x-input-textarea wire:model="description" id="description" name="description" class="mt-1 block w-full" placeholder="Enter description here" />
        </div>
    </div>
</div>
</x-app-layout>
