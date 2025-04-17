
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
