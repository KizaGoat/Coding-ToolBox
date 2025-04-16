<div id="teacher-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-05 hidden">
    <div class="bg-gray-100 rounded-lg shadow-lg max-w-md p-4 relative text-sm overflow-hidden">
        <!-- Bouton fermeture -->
        <button class="absolute top-2.5 right-3 text-gray-500 hover:text-red-600 text-xl" onclick="closeModal()">
            &times;
        </button>

        <!-- Titre -->
        <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Modifier l'enseignant</h2>

        <!-- Formulaire -->
        <form method="POST" id="edit-teacher-form" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                <input type="text" id="first_name" name="first_name"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Ex: Marie" required>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" id="last_name" name="last_name"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Ex: Dupont" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="exemple@domaine.fr" required>
            </div>

            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                <input type="date" id="birth_date" name="birth_date"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mt-4 flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-xs bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 text-xs bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Sauvegarder
                </button>
            </div>
        </form>
    </div>
</div>
