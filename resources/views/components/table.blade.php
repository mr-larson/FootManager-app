<!-- resources/views/components/table.blade.php -->
@props(['headers', 'rows'])

<div class="overflow-x-auto mt-4">
    <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
        <thead class="rounded-full bg-gray-100 dark:bg-gray-700">
        <tr>
            @foreach($headers as $header)
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
        {{ $slot }}
        </tbody>
    </table>
</div>
