<div>
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Team Rankings') }}</h3>
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Team') }}
                </th>
                <th class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Points') }}
                </th>
                <th class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Wins') }}
                </th>
                <th class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Draws') }}
                </th>
                <th class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Losses') }}
                </th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($teams as $team)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ $team->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ $team->points }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ $team->wins }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ $team->draws }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ $team->losses }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
