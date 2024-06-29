<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Teams') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 flex flex-wrap lg:flex-nowrap space-y-4 lg:space-y-0 lg:space-x-4">
        <div class="flex-1 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
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
                    <x-table :headers="['Name', 'Budget', 'Wins', 'Draws', 'Losses', '']">
                        @foreach($teams as $team)
                            <tr class="relative group">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 relative">
                                    <span class="cursor-pointer">{{ $team->name }}</span>
                                    <div class="absolute left-0 top-full mt-1 h-8 bg-gray-800 text-white text-xs rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2">
                                        {{ $team->description }}
                                    </div>
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
                                    <x-secondary-button wire:click="togglePlayers({{ $team->id }})">
                                        {{ $showPlayers[$team->id] ? __('Hide Players') : __('Show Players') }}
                                    </x-secondary-button>
                                </td>
                            </tr>
                            @if($showPlayers[$team->id] ?? false)
                                <tr>
                                    <td colspan="6" class="px-6 py-4">
                                        <x-table :headers="['First Name', 'Last Name', 'Position', 'Stats']">
                                            @foreach($team->players as $player)
                                                <tr class="">
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
                                                        {{ is_array($player->stats) ? implode(', ', $player->stats) : $player->stats }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </x-table>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </x-table>
                    <div class="mt-6">
                        {{ $teams->links() }}
                    </div>
                @endif
            </section>
        </div>

        <div class="w-full lg:w-1/5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
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
                            <x-input-label for="budget" :value="__('Budget')" />
                            <x-input-text wire:model="budget" id="budget" name="budget" type="number" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('budget')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-input-textarea wire:model="description" id="description" name="description" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
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
