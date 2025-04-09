<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-1 gap-5 lg:gap-7.5 items-stretch">
        <!-- Cohorts -->
        <div class="card card-grid h-full min-w-full flex flex-col justify-between">
            <div class="card-header">
                <h3 class="card-title text-center">
                    Promotions
                </h3>
            </div>
            <p> Total des promotions: {{ $totalproms}}</p>
            <div class="card-body flex flex-col gap-5 justify-center items-center">
                <button class="btn w-full" onclick="goToCategory('promotions')">Voir Promotions</button>
            </div>
        </div>

        <!-- Students -->
        <div class="card card-grid h-full min-w-full flex flex-col justify-between">
            <div class="card-header">
                <h3 class="card-title text-center flex justify-center items-center">
                    Etudiants
                </h3>
            </div>
            <p> Total des étudiants : {{ $totalStudents }}</p>
            <div class="card-body flex flex-col gap-5 justify-center items-center">
                <button class="btn w-full" onclick="goToCategory('etudiants')">Voir Etudiants</button>
            </div>
        </div>

        <!-- Teachers -->
        <div class="card card-grid h-full min-w-full flex flex-col justify-between">
            <div class="card-header">
                <h3 class="card-title text-center">
                    Enseignants
                </h3>
            </div>
            <p> Total des Enseignants: {{ $totalteacher  }}</p>
            <div class="card-body flex flex-col gap-5 justify-center items-center">
                <button class="btn w-full" onclick="goToCategory('enseignants')">Voir Enseignants</button>
            </div>
        </div>

        <!-- Groups -->
        <div class="card card-grid h-full min-w-full flex flex-col justify-between">
            <div class="card-header">
                <h3 class="card-title text-center">
                    Groupes
                </h3>
            </div>
            <p> Total des Groupes: {{ $totalgroups }}</p>
            <div class="card-body flex flex-col gap-5 justify-center items-center">
                <button class="btn w-full" onclick="goToCategory('groupes')">Voir Groupes</button>
            </div>
        </div>
    </div>
    <!-- link of the page  -->
    <script>
        function goToCategory(category) {
            switch (category) {
                case 'promotions':
                    window.location.href = '{{ route("pages.cohorts.index") }}';
                    break;
                case 'etudiants':
                    window.location.href = '{{ route("pages.students.index") }}';
                    break;
                case 'enseignants':
                    window.location.href = '{{ route("pages.teachers.index") }}';
                    break;
                case 'groupes':
                    window.location.href = '{{ route("pages.groups.index") }}';
                    break;
                default:
                    alert('Catégorie inconnue');
            }
        }
    </script>
    <!-- end: grid -->
</x-app-layout>
