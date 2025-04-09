<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">
            {{ __('Vie Commune') }}
        </h1>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <!-- Formulaire d'ajout de tâche -->
        <div class="bg-white shadow sm:rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Ajouter une tâche</h2>
            <form action="{{ route('commonLife.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="queue" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <input type="text" name="queue" id="queue" required
                           placeholder="Ex : toilette, Ménage, etc."
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="payload" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="payload" id="payload" required
                              placeholder="Ex : Nettoyer le micro-ondes"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>

                <div>
                    <label for="available_at" class="block text-sm font-medium text-gray-700">Disponible à (timestamp)</label>
                    <input type="number" name="available_at" id="available_at" required
                           placeholder="Ex : 1712688000"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ajouter la tâche
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des tâches -->
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Liste des Tâches de Vie Commune</h2>

            <ul class="space-y-4">
                @foreach ($tasks as $task)
                    <li class="flex justify-between items-center p-4 bg-gray-50 rounded-md shadow-sm">
                        <div>
                            <p class="font-medium text-gray-900">{{ $task->queue }} : {{ $task->payload }}</p>
                            <p class="text-sm text-gray-800">
                                Disponible à : {{ date('d/m/Y H:i', $task->available_at) }}
                            </p>
                        </div>

                        <div>
                            @if (!$task->completed)
                                <form action="{{ route('commonLife.complete', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 text-sm bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Marquer comme terminée
                                    </button>
                                </form>
                            @else
                                <span class="text-sm text-green-600 font-semibold">✅ Terminé</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</x-app-layout>
