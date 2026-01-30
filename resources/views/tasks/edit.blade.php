<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la Mission') }} : <span style="color: #4ead00;">{{ $task->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold mb-6 text-gray-800 border-b pb-4">Mettre à jour les informations</h3>
                
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Titre</label>
                        <input type="text" name="title" value="{{ $task->title }}" 
                               class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200" required>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Description</label>
                        <textarea name="description" rows="3" 
                                  class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200">{{ $task->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Statut</label>
                            <select name="status" class="w-full rounded-xl border-gray-300">
                                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>À faire</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Terminé</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Priorité</label>
                            <select name="priority" class="w-full rounded-xl border-gray-300">
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Basse</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Moyenne</option>
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Haute</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Deadline</label>
                            <input type="date" name="deadline" value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '' }}"
                                   class="w-full rounded-xl border-gray-300">

                                   

                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 font-bold">Annuler</a>
                        <button type="submit" 
                                style="background-color: #7CFC00;" 
                                class="text-black font-bold py-3 px-10 rounded-xl shadow-md hover:opacity-90 transition transform hover:scale-105">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>