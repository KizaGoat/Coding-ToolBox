<x-app-layout>
    <!-- Page header -->
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="card card-grid h-full min-w-full flex flex-col justify-between">
        <div class="card-header">
            <h3 class="card-title text-center">
                Promotions: {{ $totalproms }}
            </h3>
        </div>

        <!-- Show number of cohort -->


        <div class="card-body flex flex-col gap-5 justify-center items-center">
            <!-- Link -->
            <a href="{{ route('cohort.index') }}" class="btn w-full text-center">
                Voir Promotions
            </a>
        </div>
    </div>

    <div class="card card-grid h-full min-w-full flex flex-col justify-between">
        <div class="card-header">
            <h3 class="card-title text-center flex justify-center items-center">
                Etudiants: {{ $totalStudents }}
            </h3>
        </div>

        <!-- Show number of student -->
        <div class="card-body flex flex-col gap-5 justify-center items-center">
            <!-- Link -->
            <a href="{{ route('student.index') }}" class="btn w-full text-center">
                Voir Les Etudiants:
            </a>
        </div>
    </div>

    <div class="card card-grid h-full min-w-full flex flex-col justify-between">
        <div class="card-header">
            <h3 class="card-title text-center">
                Enseignants: {{ $totalteacher }}
            </h3>
        </div>

        <!-- Show number of teacher -->


        <div class="card-body flex flex-col gap-5 justify-center items-center">
            <!-- Link -->
            <a href="{{ route('teacher.index') }}" class="btn w-full text-center">
                Voir Les Enseingnants
            </a>
        </div>
    </div>

    <div class="card card-grid h-full min-w-full flex flex-col justify-between">
        <div class="card-header">
            <h3 class="card-title text-center">
                Groupes: {{ $totalgroups }}
            </h3>
        </div>

        <!-- Show number of groups -->

        <div class="card-body flex flex-col gap-5 justify-center items-center">
            <!-- Link  -->
            <a href="{{ route('group.index') }}" class="btn w-full text-center">
                Voir Les Groupes
            </a>
        </div>
    </div>

    <!-- end: grid -->
</x-app-layout>
