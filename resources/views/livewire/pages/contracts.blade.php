@php use Carbon\Carbon; @endphp
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Contracts') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 flex space-x-4">
        <div class="flex-1 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('List of all contracts.') }}
                    </h2>
                </header>

                @if($contracts->isEmpty())
                    <div class="mt-4 text-center text-gray-600 dark:text-gray-400">
                        {{ __('No contracts found. Please create a new contract.') }}
                    </div>
                @else
                    <x-table :headers="['Player', 'Team', 'Salary', 'Start Date', 'End Date', '']">
                        @foreach($contracts as $contract)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $contract->player->firstname }} {{ $contract->player->lastname }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $contract->team->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $contract->salary }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ Carbon::parse($contract->start_date)->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ Carbon::parse($contract->end_date)->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <x-primary-button
                                        wire:click="editContract({{ $contract->id }})">{{ __('Edit') }}</x-primary-button>
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
                            {{ $contractId ? __('Update Contract') : __('Create Contract') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $contractId ? __('Update the contract details below.') : __('Create a new contract by filling out the form below.') }}
                        </p>
                    </header>

                    <form wire:submit.prevent="{{ $contractId ? 'updateContract' : 'createContract' }}"
                          class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="player_id" :value="__('Player')"/>
                            <x-input-select
                                wire:model="player_id"
                                id="player_id"
                                placeholder="Choose a player"
                                :options="$players->pluck('fullname', 'id')->toArray()"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('player_id')"/>
                        </div>

                        <div>
                            <x-input-label for="team_id" :value="__('Team')"/>
                            <x-input-select
                                wire:model="team_id"
                                id="team_id"
                                placeholder="Choose a team"
                                :options="$teams->pluck('name', 'id')->toArray()"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('team_id')"/>
                        </div>

                        <div>
                            <x-input-label for="salary" :value="__('Salary')"/>
                            <x-input-text wire:model="salary" id="salary" name="salary" type="number"
                                          class="mt-1 block w-full" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('salary')"/>
                        </div>

                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')"/>
                            <x-input-text wire:model="start_date" id="start_date" name="start_date" type="date"
                                          class="mt-1 block w-full" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')"/>
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End Date')"/>
                            <x-input-text wire:model="end_date" id="end_date" name="end_date" type="date"
                                          class="mt-1 block w-full" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button
                                class="w-full py-2">{{ $contractId ? __('Update') : __('Save') }}</x-primary-button>
                            @if($contractId)
                                <x-danger-button wire:click="deleteContract({{ $contractId }})"
                                                 class="w-full py-2">{{ __('Delete') }}</x-danger-button>
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
