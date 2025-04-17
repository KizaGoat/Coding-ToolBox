    // function to open the edit modal with current data
    function openEditModal(id, first_name, last_name, email, birth_date) {
    // populate form fields with the passed data
    document.getElementById('first_name').value = first_name;
    document.getElementById('last_name').value = last_name;
    document.getElementById('email').value = email;
    document.getElementById('birth_date').value = birth_date;

    // set the form action URL for updating the teacher's data
    document.getElementById('edit-teacher-form').action = `/teacher/${id}`;

    // show the modal by removing the 'hidden' class
    document.getElementById('teacher-modal').classList.remove('hidden');
}

    // function to close the modal
    function closeModal() {
    // hide the modal by adding the 'hidden' class
    document.getElementById('teacher-modal').classList.add('hidden');
}
