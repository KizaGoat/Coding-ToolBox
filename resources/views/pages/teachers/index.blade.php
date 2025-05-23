<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('enseignant') }}
            </span>
        </h1>
    </x-slot>

    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <!-- card Header -->
                    <div class="card-header">
                        <h3 class="card-title">Liste des enseignants</h3>
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <!-- search input to filter teachers -->
                            <input placeholder="Rechercher un enseignant" type="text"/>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <!-- table headers for teacher information -->
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">Nom</th>
                                        <th class="min-w-[135px]">Prénom</th>
                                        <th class="min-w-[135px]">Date de naissance</th>
                                        <th class="w-[70px]">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_schools as $user_schoolsss)
                                        <tr>
                                            <td>{{ $user_schoolsss->user->last_name }}</td>
                                            <td>{{ $user_schoolsss->user->first_name }}</td>
                                            <td>{{ $user_schoolsss->user->birth_date }}</td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <!-- edit button to open modal -->
                                                    <button
                                                        type="button"
                                                        class="bg-blue-500 text-white px-2 py-1 rounded-md text-sm"
                                                        onclick="openEditModal({{ $user_schoolsss->id }}, '{{ $user_schoolsss->user->first_name }}', '{{ $user_schoolsss->user->last_name }}', '{{ $user_schoolsss->user->email }}', '{{ $user_schoolsss->user->birth_date }}')"
                                                    >
                                                        <!-- edit button -->
                                                        Modifier
                                                    </button>
                                                    <!-- delete form to remove the teacher -->
                                                    <form method="POST" action="{{ route('teacher.destroy', $user_schoolsss->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md text-sm">
                                                            <!-- delete button -->
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

                            <!-- card footer with pagination control -->
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <!-- dropdown to select number of record per page -->
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <!-- information about current page -->
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- forms for add teacher -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un enseignant</h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <form method="POST" action="{{ route('teacher.store') }}" class="card-body flex flex-col gap-5 p-10">
                        @csrf
                        <x-forms.input name="Prenom" :label="__('Prénom')" />
                        <x-forms.input name="name" :label="__('Nom')" />
                        <x-forms.input type="email" name="Email" :label="__('Email')" />
                        <x-forms.input type="date" name="year" :label="__('Date de naissance')" />
                        <label for="cohorts" class="font-medium text-sm text-gray-700">Promotions</label>
                        <select name="cohorts[]" multiple class="form-select rounded-md shadow-sm w-full">
                            @foreach(App\Models\Cohort::all() as $cohort)
                                <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                            @endforeach
                        </select>
                        <x-forms.primary-button>{{ __('Valider') }}</x-forms.primary-button>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Include the modal --}}
    @include('pages.teachers.teacher-modal')

    <!-- include JS  -->
    <script src="{{ asset('js/edit-teacher.js') }}"></script>
</x-app-layout>
