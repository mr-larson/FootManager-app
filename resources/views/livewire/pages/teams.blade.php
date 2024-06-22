<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Teams') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 flex space-x-4">
        <div class="flex-1 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('List of all teams.') }}
                    </h2>
                </header>

                @if($teams->isEmpty())
                    <div class="mt-4 text-center text-gray-600 dark:text-gray-400">
                        {{ __('No teams found. Please create a new team.') }}
                    </div>
                @else
                    <x-table :headers="['Name', 'Description', 'Budget', 'Wins', 'Draws', 'Losses', '', '']">
                        @foreach($teams as $team)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $team->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $team->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $team->budget }}
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
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <x-primary-button wire:click="editTeam({{ $team->id }})">{{ __('Edit') }}</x-primary-button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    <x-show>
                                        <x-slot name="trigger">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <span x-show="!show">{{ __('Show Players') }}</span>
                                                <span x-show="show">{{ __('Hide Players') }}</span>
                                            </button>
                                        </x-slot>
                                        <x-table :headers="['First Name', 'Last Name', 'Position', 'Age', 'Cost', 'Stats']">
                                            @foreach($team->players as $player)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        {{ $player->firstname }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        {{ $player->lastname }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        {{ $player->position }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        {{ $player->age }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        {{ $player->cost }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        {{ is_array($player->stats) ? implode(', ', $player->stats) : $player->stats }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </x-table>
                                    </x-show>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                @endif
            </section>
        </div>

        <div class="w-1/5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $teamId ? __('Update Team') : __('Create Team') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $teamId ? __('Update the team details below.') : __('Create a new team by filling out the form below.') }}
                        </p>
                    </header>

                    <form wire:submit.prevent="{{ $teamId ? 'updateTeam' : 'createTeam' }}" class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-input-text wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-input-textarea wire:model="description" id="description" name="description" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="budget" :value="__('Budget')" />
                            <x-input-text wire:model="budget" id="budget" name="budget" type="number" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('budget')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="w-full py-2">{{ $teamId ? __('Update') : __('Save') }}</x-primary-button>
                            @if($teamId)
                                <x-danger-button wire:click="deleteTeam({{ $teamId }})" class="w-full py-2">{{ __('Delete') }}</x-danger-button>
                            @endif

                            @if (session()->has('message'))
                                <x-action-message class="me-3" on="saved">
                                    {{ session('message') }}
                                </x-action-message>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
