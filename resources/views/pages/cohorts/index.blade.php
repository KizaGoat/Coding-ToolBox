<x-app-layout>
    <!-- header section -->
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Promotions') }}
            </span>
        </h1>
    </x-slot>

    <!-- grid layout for main content -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <!-- card header -->
                    <div class="card-header">
                        <h3 class="card-title">Mes promotions</h3>
                    </div>
                    <div class="card-body">
                        <!-- table for listing promotions -->
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[280px]">
                                                <span class="sort asc">
                                                    <span class="sort-label">Promotion</span>
                                                    <span class="sort-icon"></span>
                                                </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                                <span class="sort">
                                                    <span class="sort-label">Année</span>
                                                    <span class="sort-icon"></span>
                                                </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                                <span class="sort">
                                                    <span class="sort-label">Actions</span>
                                                    <span class="sort-icon"></span>
                                                </span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cohorts as $cohort)
                                        <tr>
                                            <!-- promotion name and description -->
                                            <td>
                                                <div class="flex flex-col gap-2">
                                                    <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary" href="{{ route('cohort.show', $cohort->id) }}">
                                                        {{ $cohort->name }}
                                                    </a>
                                                    <span class="text-2sm text-gray-700 font-normal leading-3">
                                                            {{ $cohort->description }}
                                                        </span>
                                                </div>
                                            </td>
                                            <!-- display year  -->
                                            <td>{{ \Carbon\Carbon::parse($cohort->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($cohort->end_date)->format('Y') }}</td>
                                            <td>
                                                <!-- edit button  -->
                                                <button
                                                    type="button"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded-md"
                                                    onclick="openEditModal({{ $cohort->id }}, '{{ $cohort->name }}', '{{ $cohort->description }}', '{{ $cohort->start_date }}', '{{ $cohort->end_date }}')"
                                                >
                                                    Modifier
                                                </button>

                                                <!-- delete button -->
                                                <form method="POST" action="{{ route('cohort.destroy', $cohort->id) }}" style="display: inline-block;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="card h-full">
                <!-- card header for adding a cohort -->
                <div class="card-header">
                    <h3 class="card-title">Ajouter une promotion</h3>
                </div>
                <form method="POST" action="{{ route('cohort.store') }}">
                    @csrf
                    <!-- form fields for adding a cohort-->
                    <x-forms.input name="name" :label="__('Nom')" />
                    <x-forms.input name="description" :label="__('Description')" />
                    <x-forms.input type="date" name="start_date" :label="__('Début de l\'année')" />
                    <x-forms.input type="date" name="end_date" :label="__('Fin de l\'année')" />
                    <x-forms.primary-button>{{ __('Valider') }}</x-forms.primary-button>
                </form>
            </div>
        </div>

    </div>

    <!-- modal inclusion -->
    @include('pages.cohorts.cohort-modal')
</x-app-layout>
