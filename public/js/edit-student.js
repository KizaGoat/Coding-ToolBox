// Open the modal with student data
function openEditModal(id, first_name, last_name, email, birth_date) {
    document.getElementById('first_name').value = first_name;
    document.getElementById('last_name').value = last_name;
    document.getElementById('email').value = email;
    document.getElementById('birth_date').value = birth_date;
    // Set form action
    document.getElementById('edit-student-form').action = `/student/${id}`;
    // Show modal
    document.getElementById('student-modal').classList.remove('hidden');
}

// Close the modal
function closeModal() {
    document.getElementById('student-modal').classList.add('hidden'); // Hide modal
}
