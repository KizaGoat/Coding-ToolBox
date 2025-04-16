<x-app-layout>
    <x-slot name="header">
        <!-- Page Header displaying the title 'Etudiants' -->
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Etudiants') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des étudiants</h3>
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un étudiant" type="text"/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">Nom</th>
                                        <th class="min-w-[135px]">Prénom</th>
                                        <th class="min-w-[135px]">Date de naissance</th>
                                        <th class="w-[70px]">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- student list -->
                                    @foreach($user_schools as $user_schoolsss)
                                        <tr>
                                            <td>{{ $user_schoolsss->user->last_name }}</td>
                                            <td>{{ $user_schoolsss->user->first_name }}</td>
                                            <td>{{ $user_schoolsss->user->birth_date }}</td>
                                            <td>
                                                <div class="flex items-center justify-between">

                                                    <!-- Modifier button -->
                                                    <button type="button" class="hover:text-primary cursor-pointer"
                                                            onclick="openEditModal({{ $user_schoolsss->id }}, '{{ $user_schoolsss->user->first_name }}', '{{ $user_schoolsss->user->last_name }}', '{{ $user_schoolsss->user->email }}', '{{ $user_schoolsss->user->birth_date }}')">
                                                        <i class="ki-filled ki-pencil"></i> Modifier
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <form method="POST" action="{{ route('student.destroy', $user_schoolsss->id) }}" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un étudiant</h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- form for create student -->
                    <form method="POST" action="{{ route('student.store') }}" class="card-body flex flex-col gap-5 p-10">
                        @csrf
                        <x-forms.input name="Prenom" :label="__('Prénom')" />
                        <x-forms.input name="name" :label="__('Nom')" />
                        <x-forms.input type="email" name="Email" :label="__('Email')" />
                        <x-forms.input type="date" name="year" :label="__('Date de naissance')" placeholder=""/>

                        <!-- Submit button  -->
                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>

                        <!-- Success message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->

    <!-- Edit Student Modal -->
    <div id="student-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="bg-gray-100 rounded-lg shadow-lg max-w-md p-4 relative text-sm overflow-hidden">
            <!-- Close Button -->
            <button class="absolute top-2.5 right-3 text-gray-500 hover:text-red-600 text-xl" onclick="closeModal()">
                &times;
            </button>

            <!-- Title -->
            <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Modifier l'étudiant</h2>

            <!-- Edit Form -->
            <form method="POST" id="edit-student-form" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                    <input type="text" id="first_name" name="first_name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Ex: Marie" required>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input type="text" id="last_name" name="last_name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Ex: Dupont" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="exemple@domaine.fr" required>
                </div>

                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                    <input type="date" id="birth_date" name="birth_date"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div class="mt-4 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-xs bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 text-xs bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
