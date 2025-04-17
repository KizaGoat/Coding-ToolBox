<div id="student-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-100 rounded-lg shadow-lg max-w-md p-4 relative text-sm overflow-hidden">

        <!-- close button -->
        <button class="absolute top-2.5 right-3 text-gray-500 hover:text-red-600 text-xl" onclick="closeModal()">
            &times;
        </button>

        <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Edit Student</h2>

        <!-- edit form -->
        <form method="POST" id="edit-student-form" class="space-y-4" action="">
            @csrf
            @method('PUT')

            <input type="hidden" id="student_id" name="student_id">

            <!-- first name -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                <input type="text" id="first_name" name="first_name"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="e.g. Marie" required>
            </div>

            <!-- last name -->
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                <input type="text" id="last_name" name="last_name"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="e.g. Dupont" required>
            </div>

            <!-- email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="e.g. user@example.com" required>
            </div>

            <!-- birth date -->
            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- cohorts  -->
            <label for="cohorts" class="font-medium text-sm text-gray-700">Promotions</label>
            <select name="cohorts[]" id="cohorts" multiple class="form-select rounded-md shadow-sm w-full">
                @foreach(App\Models\Cohort::all() as $cohort)
                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                @endforeach
            </select>

            <!-- button -->
            <div class="mt-4 flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-xs bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-xs bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
