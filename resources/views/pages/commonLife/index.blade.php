<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie Commune') }}
            </span>
        </h1>
    </x-slot>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .task { padding: 10px; margin-bottom: 10px; background: #f8f9fa; }
            .completed { background: #28a745; color: white; text-decoration: line-through; }
        </style>
    </head>
    <body>

    <div>
        <h2>Tâches</h2>
        <input type="text" id="taskInput" placeholder="Nouvelle tâche" />
        <button onclick="addTask()">Ajouter</button>

        <ul id="taskList"></ul>
    </div>

    <script>
        // Ajouter une tâche
        function addTask() {
            const taskName = $('#taskInput').val();
            if (taskName) {
                $.ajax({
                    url: '/tasks',
                    type: 'POST',
                    data: {
                        task_name: taskName,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(task) {
                        $('#taskList').append(`
                        <li id="task-${task.id}" class="task">
                            <span>${task.name}</span>
                            <button onclick="toggleCompletion(${task.id})">Marquer comme terminé</button>
                            <button onclick="deleteTask(${task.id})">Supprimer</button>
                        </li>
                    `);
                        $('#taskInput').val('');
                    }
                });
            }
        }

        // Marquer une tâche comme terminée
        function toggleCompletion(taskId) {
            $.ajax({
                url: `/tasks/${taskId}/toggle`,
                type: 'PUT',
                data: { _token: '{{ csrf_token() }}' },
                success: function(task) {
                    const taskElement = $(`#task-${task.id}`);
                    taskElement.toggleClass('completed');
                }
            });
        }

        // Supprimer une tâche
        function deleteTask(taskId) {
            $.ajax({
                url: `/tasks/${taskId}`,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    $(`#task-${taskId}`).remove();
                }
            });
        }

        // Charger les tâches existantes lors du chargement de la page
        $(document).ready(function() {
            $.get('/tasks', function(tasks) {
                tasks.forEach(task => {
                    $('#taskList').append(`
                    <li id="task-${task.id}" class="task ${task.completed ? 'completed' : ''}">
                        <span>${task.name}</span>
                        <button onclick="toggleCompletion(${task.id})">Marquer comme terminé</button>
                        <button onclick="deleteTask(${task.id})">Supprimer</button>
                    </li>
                `);
                });
            });
        });
    </script>

    </body>
    </html>

</x-app-layout>
