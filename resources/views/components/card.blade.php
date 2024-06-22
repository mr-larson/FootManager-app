<div {{ $attributes->merge(['class' => 'bg-gray-100 dark:bg-gray-700 shadow border relative overflow-x-auto sm:rounded-lg']) }}>
    <div class="bg-gradient-to-r from-blue-500 to-blue-400 px-4 py-1 text-lg font-medium text-gray-50 dark:text-gray-100 rounded-t-lg">
        {{ $title }}
    </div>
    <div class="m-4">
        {{ $content }}
    </div>
    <div class="flex flex-wrap justify-around m-4">
        {{ $actions }}
    </div>
</div>
