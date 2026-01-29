<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier la tâche : {{ $task->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PATCH') <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Titre</label>
                        <input type="text" name="title" value="{{ $task->title }}" class="w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Statut</label>
                        <select name="status" class="w-full rounded border-gray-300">
                            <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>À faire</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                            <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Terminé</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Priorité</label>
                        <select name="priority" class="w-full rounded border-gray-300">
                            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Basse</option>
                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Moyenne</option>
                            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Haute</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>