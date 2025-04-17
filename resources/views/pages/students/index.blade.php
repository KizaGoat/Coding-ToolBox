<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Etudiants') }}
            </span>
        </h1>
    </x-slot>

    <!-- start  -->
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

                                                    <!-- edit button -->
                                                    <button
                                                        type="button"
                                                        class="bg-blue-500 text-white px-2 py-1 rounded-md text-sm"
                                                        onclick="openEditModal({{ $user_schoolsss->id }}, '{{ $user_schoolsss->user->first_name }}', '{{ $user_schoolsss->user->last_name }}', '{{ $user_schoolsss->user->email }}', '{{ $user_schoolsss->user->birth_date }}')">
                                                        Modifier
                                                    </button>
                                                    <!-- delete button -->
                                                    <form method="POST" action="{{ route('student.destroy', $user_schoolsss->id) }}" style="display: inline;">
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
                    <!-- forms for create student -->
                    <form method="POST" action="{{ route('student.store') }}" class="card-body flex flex-col gap-5 p-10">
                        @csrf
                        <x-forms.input name="Prenom" :label="__('Prénom')" />
                        <x-forms.input name="name" :label="__('Nom')" />
                        <x-forms.input type="email" name="Email" :label="__('Email')" />
                        <x-forms.input type="date" name="year" :label="__('Date de naissance')" placeholder=""/>
                        <label for="cohort_id">Promotion</label>
                        <select name="cohort_id" id="cohort_id" class="form-select" required>
                            @foreach($cohorts as $cohort)
                                <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                            @endforeach
                        </select>
                        <!-- soumission button -->
                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>

                        <!-- success message -->
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
    <!-- Include the modal -->
    @include('pages.students.student-modal')

    <!-- include JS  -->
    <script src="{{ asset('js/edit-student.js') }}"></script>

</x-app-layout>
