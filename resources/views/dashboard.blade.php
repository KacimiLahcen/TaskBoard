<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Tâches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('tasks.create') }}" 
                   style="background-color: #7CFC00;" 
                   class="hover:opacity-80 text-black font-bold py-2 px-4 rounded shadow">
                    + Ajouter une tâche
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Titre</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Priorité</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $task->title }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span class="px-2 py-1 font-semibold leading-tight text-{{ $task->priority == 'high' ? 'red' : 'green' }}-700 bg-{{ $task->priority == 'high' ? 'red' : 'green' }}-100 rounded-full text-xs uppercase">
                                    {{ $task->priority }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <div class="flex items-center">
                                    <span class="h-2 w-2 rounded-full mr-2" style="background-color: #7CFC00;"></span>
                                    <span class="text-gray-700">{{ str_replace('_', ' ', $task->status) }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('tasks.edit', $task) }}" 
                                       class="text-blue-600 hover:text-blue-900 font-bold decoration-blue-500">
                                        Modifier
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Archiver cette tâche ?');" class="inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold">
                                            Archiver
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>




