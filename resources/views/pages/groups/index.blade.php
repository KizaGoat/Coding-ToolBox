<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Groupes') }}
            </span>
        </h1>
    </x-slot>
        <!-- Groupes -->
        <div class="card card-grid h-full min-w-full flex flex-col justify-between">
            <div class="card-header">
                <h3 class="card-title text-center">
                   Tous les Groupes
                </h3>
            </div>
        </div>

</x-app-layout>
