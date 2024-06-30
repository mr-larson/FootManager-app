<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Soccer Matches') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 flex flex-wrap lg:flex-nowrap space-y-4 lg:space-y-0 lg:space-x-4">
        <div class="flex-1 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
            <section class="max-w-5xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('List of all soccer matches.') }}
                    </h2>
                </header>

                @if($matches->isEmpty())
                    <div class="mt-4 text-center text-gray-600 dark:text-gray-400">
                        {{ __('No matches found. Please create a new match.') }}
                    </div>
                @else
                    <x-table :headers="['Home Team', 'Away Team', 'Score', 'Date', '']">
                        @foreach($matches as $match)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $match->homeTeam->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $match->awayTeam->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $match->score_team_home ?? '-' }} - {{ $match->score_team_away ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $match->date->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <x-primary-button wire:click="editMatch({{ $match->id }})">{{ __('Edit') }}</x-primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                    <div class="mt-6">
                        {{ $matches->links() }}
                    </div>
                @endif
            </section>
        </div>

        <div class="w-full lg:w-1/5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $matchId ? __('Update Match') : __('Create Match') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $matchId ? __('Update the match details below.') : __('Create a new match by filling out the form below.') }}
                        </p>
                    </header>

                    <form wire:submit.prevent="{{ $matchId ? 'updateMatch' : 'createMatch' }}" class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="team_id_home" :value="__('Home Team')" />
                            <x-input-select wire:model="team_id_home"
                                            id="team_id_home" name="team_id_home"
                                            class="mt-1 block w-full"
                                            :options="$teams->pluck('name', 'id')->toArray()"
                                            required>
                            </x-input-select>
                            <x-input-error class="mt-2" :messages="$errors->get('team_id_home')" />
                        </div>

                        <div>
                            <x-input-label for="team_id_away" :value="__('Away Team')" />
                            <x-input-select
                                wire:model="team_id_away"
                                id="team_id_away"
                                name="team_id_away"
                                class="mt-1 block w-full"
                                :options="$teams->pluck('name', 'id')->toArray()"
                                required>
                            </x-input-select>
                            <x-input-error class="mt-2" :messages="$errors->get('team_id_away')" />
                        </div>

                        <div>
                            <x-input-label for="score_team_home" :value="__('Home Team Score')" />
                            <x-input-text wire:model="score_team_home" id="score_team_home" name="score_team_home" type="number" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('score_team_home')" />
                        </div>

                        <div>
                            <x-input-label for="score_team_away" :value="__('Away Team Score')" />
                            <x-input-text wire:model="score_team_away" id="score_team_away" name="score_team_away" type="number" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('score_team_away')" />
                        </div>

                        <div>
                            <x-input-label for="date" :value="__('Match Date')" />
                            <x-input-text wire:model="date" id="date" name="date" type="date" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button class="w-full py-2">{{ $matchId ? __('Update') : __('Save') }}</x-primary-button>
                            @if($matchId)
                                <x-danger-button wire:click="deleteMatch({{ $matchId }})" class="w-full py-2">{{ __('Delete') }}</x-danger-button>
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
