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
                @if(session('success'))
                <div id="success-popup"
                    class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50">
                    <div style="background-color: #7CFC00;"
                        class="px-6 py-3 rounded-full shadow-2xl border border-black flex items-center space-x-2 animate-bounce">
                        <span class="text-lg">✅</span>
                        <p class="font-bold text-sm text-black whitespace-nowrap">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
                <script>
                    setTimeout(() => {
                        const popup = document.getElementById('success-popup');
                        if (popup) {
                            popup.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                            setTimeout(() => popup.remove(), 500);
                        }
                    }, 2500);
                </script>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Titre</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Priorité</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deadline</th>
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
                                <div class="flex items-center">
                                    <span class="h-2 w-2 rounded-full mr-2" style="background-color: #7CFC00;"></span>
                                    <span class="text-gray-700">{{ str_replace('_', ' ', $task->deadline) }}</span>
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
                                        <!-- <button type="submit" class="text-red-600 hover:text-red-900 font-bold">
                                            Archiver
                                        </button> -->

                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('tasks.destroy', $task) }}', '{{ $task->title }}')"
                                            class="text-red-600 hover:text-red-900 font-bold transition duration-150">
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






    <div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl transform transition-all">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Confirmar l'archivage</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Êtes-vous sûr de vouloir archiver la tâche : <br>
                        <span id="task-title-modal" class="font-bold text-black"></span> ?
                    </p>
                </div>

                <div class="flex flex-col space-y-2">
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-bold text-white hover:bg-red-700 focus:outline-none sm:text-sm transition">
                            Oui, Archiver
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()"
                        class="w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(actionUrl, taskTitle) {
            document.getElementById('delete-form').action = actionUrl;
            document.getElementById('task-title-modal').innerText = taskTitle;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>




</x-app-layout>