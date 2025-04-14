<x-app-layout>
    <x-slot name="header">
        <!-- Page Header displaying the title 'Enseignant' -->
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('enseignant') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">

        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des enseignants</h3>

                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un enseignant" type="text"/>
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
                                    <!-- teachers list -->
                                    @foreach($user_schools as $user_schoolsss)
                                        <tr>
                                            <td>{{ $user_schoolsss->user->last_name }}</td>
                                            <td>{{ $user_schoolsss->user->first_name }}</td>
                                            <td>{{ $user_schoolsss->user->birth_date }}</td>
                                            <td>
                                                <div class="flex items-center justify-between">

                                                    <a href="#">
                                                        <i class="text-success ki-filled ki-shield-tick"></i>
                                                    </a>

                                                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#student-modal">
                                                        <i class="ki-filled ki-cursor"></i>
                                                    </a>
                                                </div>
                                                <!-- delete button for delete teacher -->
                                                <form method="POST" action="{{ route('teacher.destroy', $user_schoolsss->id) }}" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">
                                                        Supprimer
                                                    </button>
                                                </form>
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
                    <h3 class="card-title">Ajouter un enseignant</h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <!-- form for creat teacher -->
                    <form method="POST" action="{{ route('teacher.store') }}" class="card-body flex flex-col gap-5 p-10">
                        @csrf
                        <x-forms.input name="Prenom" :label="__('Prénom')" />
                        <x-forms.input name="name" :label="__('Nom')" />
                        <x-forms.input type="email" name="Email" :label="__('Email')" />
                        <x-forms.input type="date" name="year" :label="__('Date de naissance')" placeholder=""/>

                        <!-- submit button -->
                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>

                        <!-- message if teacher is added -->
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
</x-app-layout>
