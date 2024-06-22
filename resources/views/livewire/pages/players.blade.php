<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Players') }}
        </h2>
    </div>
</x-slot>

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 flex space-x-4">
        <div class="flex-1 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('List of all players.') }}
                    </h2>
                </header>

                @if($players->isEmpty())
                    <div class="mt-4 text-center text-gray-600 dark:text-gray-400">
                        {{ __('No players found. Please create a new player.') }}
                    </div>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
                        @foreach($players as $player)
                            <x-card>
                                <x-slot name="title">
                                    {{ $player->firstname }} {{ $player->lastname }}
                                </x-slot>
                                <x-slot name="content">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Position') }}: {{ $player->position }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Age') }}: {{ $player->age }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Cost') }}: {{ $player->cost }}</div>
                                    @if(is_array($player->stats))
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Speed: {{ $player->stats['speed'] }}, Stamina: {{ $player->stats['stamina'] }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Defense: {{ $player->stats['defense'] }}, Attack: {{ $player->stats['attack'] }}</div>
                                    @else
                                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $player->stats }}</div>
                                    @endif
                                </x-slot>
                                <x-slot name="actions">
                                    <x-primary-button wire:click="editPlayer({{ $player->id }})">{{ __('Edit') }}</x-primary-button>
                                    <x-secondary-button>
                                        <a href="{{ route('contracts', ['player_id' => $player->id]) }}">{{ __('Contracts') }}</a>
                                    </x-secondary-button>
                                </x-slot>
                            </x-card>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>

        <div class="w-1/5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $playerId ? __('Update Player') : __('Create Player') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $playerId ? __('Update the player details below.') : __('Create a new player by filling out the form below.') }}
                        </p>
                    </header>

                    <form wire:submit.prevent="{{ $playerId ? 'updatePlayer' : 'createPlayer' }}" class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="firstname" :value="__('First Name')" />
                            <x-input-text wire:model="firstname" id="firstname" name="firstname" type="text" class="mt-1 block w-full" required autofocus autocomplete="firstname" />
                            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
                        </div>

                        <div>
                            <x-input-label for="lastname" :value="__('Last Name')" />
                            <x-input-text wire:model="lastname" id="lastname" name="lastname" type="text" class="mt-1 block w-full" required autocomplete="lastname" />
                            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                        </div>

                        <div>
                            <x-input-label for="age" :value="__('Age')" />
                            <x-input-text wire:model="age" id="age" name="age" type="number" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>

                        <div>
                            <x-input-label for="position" :value="__('Position')" />
                            <x-input-text wire:model="position" id="position" name="position" type="text" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('position')" />
                        </div>

                        <div>
                            <x-input-label for="cost" :value="__('Cost')" />
                            <x-input-text wire:model="cost" id="cost" name="cost" type="number" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('cost')" />
                        </div>

                        <div>
                            <x-input-label for="stats" :value="__('Stats')" />
                            <x-input-text wire:model="stats.speed" id="stats.speed" name="stats.speed" type="number" class="mt-1 block w-full" placeholder="Speed" required />
                            <x-input-text wire:model="stats.stamina" id="stats.stamina" name="stats.stamina" type="number" class="mt-1 block w-full" placeholder="Stamina" required />
                            <x-input-text wire:model="stats.defense" id="stats.defense" name="stats.defense" type="number" class="mt-1 block w-full" placeholder="Defense" required />
                            <x-input-text wire:model="stats.attack" id="stats.attack" name="stats.attack" type="number" class="mt-1 block w-full" placeholder="Attack" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stats')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="w-full py-2">{{ $playerId ? __('Update') : __('Save') }}</x-primary-button>
                            @if($playerId)
                                <x-danger-button wire:click="deletePlayer({{ $playerId }})" class="w-full py-2">{{ __('Delete') }}</x-danger-button>
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
