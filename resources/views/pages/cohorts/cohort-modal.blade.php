<div id="editCohortModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-gray-100">
        <!-- modal header with close button -->
        <div class="px-4 py-3 border-b flex justify-between items-center">
            <h3 class="text-lg font-medium">Edit Cohort</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeEditModal()">
                <!-- close icon -->
            </button>
        </div>

        <!-- modal content with form -->
        <div class="px-4 py-3">
            <div id="alert-error" class="mb-3 hidden bg-red-50 text-red-800 p-3 rounded-md text-sm"></div>

            <form id="editCohortForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <!-- cohort name -->
                    <div>
                        <label for="edit_name" class="block text-sm font-medium mb-1">Name *</label>
                        <input type="text" name="name" id="edit_name" required>
                    </div>

                    <!-- cohort description -->
                    <div>
                        <label for="edit_description" class="block text-sm font-medium mb-1">Description</label>
                        <textarea name="description" id="edit_description" rows="3"></textarea>
                    </div>

                    <!-- start and end dates -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="edit_start_date" class="block text-sm font-medium mb-1">Start Date *</label>
                            <input type="date" name="start_date" id="edit_start_date" required>
                        </div>
                        <div>
                            <label for="edit_end_date" class="block text-sm font-medium mb-1">End Date *</label>
                            <input type="date" name="end_date" id="edit_end_date" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- modal footer with Cancel and save buttons -->
        <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-2 rounded-b-lg">
            <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-700">Cancel</button>
            <button type="button" onclick="submitEditForm()" class="px-4 py-2 text-white bg-blue-600">Save</button>
        </div>
    </div>
</div>
<!-- include JS  -->
<script src="{{ asset('js/edit-cohort.js') }}"></script>

