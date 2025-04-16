<div id="editCohortModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-gray-100 ">
        <!-- Modal Header -->
        <div class="px-4 py-3 border-b flex justify-between items-center">
            <h3 class="text-lg font-medium">Modifier la promotion</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeEditModal()">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="px-4 py-3">
            <div id="alert-error" class="mb-3 hidden bg-red-50 text-red-800 p-3 rounded-md text-sm"></div>

            <form id="editCohortForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="space-y-3">
                    <!-- Nom -->
                    <div>
                        <label for="edit_name" class="block text-sm font-medium mb-1">Nom *</label>
                        <input type="text"
                               name="name"
                               id="edit_name"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                               required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="edit_description" class="block text-sm font-medium mb-1">Description</label>
                        <textarea name="description"
                                  id="edit_description"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                  rows="3"></textarea>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="edit_start_date" class="block text-sm font-medium mb-1">Date de début *</label>
                            <input type="date"
                                   name="start_date"
                                   id="edit_start_date"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                   required>
                        </div>

                        <div>
                            <label for="edit_end_date" class="block text-sm font-medium mb-1">Date de fin *</label>
                            <input type="date"
                                   name="end_date"
                                   id="edit_end_date"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                   required>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-2 rounded-b-lg">
            <button type="button"
                    onclick="closeEditModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Annuler
            </button>
            <button type="button"
                    onclick="submitEditForm()"
                    class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Enregistrer
            </button>
        </div>
    </div>
</div>

<script>
    // function to open the edit modal and populate the form
    function openEditModal(id, name, description, startDate, endDate) {
        // set form action URL for editing the cohort
        document.getElementById('editCohortForm').action = `/cohort/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;

        // try to format the start and end dates to ISO format
        try {
            document.getElementById('edit_start_date').value = new Date(startDate).toISOString().split('T')[0];
            document.getElementById('edit_end_date').value = new Date(endDate).toISOString().split('T')[0];
        } catch(e) {
            // fallback if date format is not valid
            document.getElementById('edit_start_date').value = startDate;
            document.getElementById('edit_end_date').value = endDate;
        }

        // show the modal and hide the error alert
        document.getElementById('editCohortModal').classList.remove('hidden');
        document.getElementById('alert-error').classList.add('hidden');
    }

    // function to close the edit modal
    function closeEditModal() {
        document.getElementById('editCohortModal').classList.add('hidden');
    }

    // function to submit the form after validation
    function submitEditForm() {
        // simple validation for required fields
        const name = document.getElementById('edit_name').value.trim();
        const startDate = document.getElementById('edit_start_date').value;
        const endDate = document.getElementById('edit_end_date').value;

        // check if all required fields are filled
        if (!name || !startDate || !endDate) {
            document.getElementById('alert-error').textContent = "Please fill in all required fields.";
            document.getElementById('alert-error').classList.remove('hidden');
            return;
        }

        // check if start date is before end date
        if (new Date(startDate) > new Date(endDate)) {
            document.getElementById('alert-error').textContent = "Start date must be earlier than end date.";
            document.getElementById('alert-error').classList.remove('hidden');
            return;
        }

        // submit the form if all validations
        document.getElementById('editCohortForm').submit();
    }

    // close the modal when pressing Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditModal();
        }
    });

    // close the modal if clicking outside the modal content
    document.getElementById('editCohortModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>
