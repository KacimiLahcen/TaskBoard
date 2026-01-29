<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une nouvelle Mission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold mb-6 text-gray-800 border-b pb-4">Détails de la tâche</h3>
                
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Titre de la mission</label>
                        <input type="text" name="title" placeholder="Ex: Organiser chambre" 
                               class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 transition duration-200" required>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Description (Optionnel)</label>
                        <textarea name="description" rows="3" placeholder="Détails de la tâche..." 
                                  class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 transition duration-200"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Niveau de Priorité</label>
                            <select name="priority" class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 transition duration-200">
                                <option value="low">Faible (Low)</option>
                                <option value="medium" selected>Moyenne (Medium)</option>
                                <option value="high">Haute (High)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Deadline :</label>
                            <input type="date" name="deadline" 
                                   class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 transition duration-200">
                        
                                   @error('deadline')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" 
                                style="background-color: #7CFC00;" 
                                class="text-black font-bold py-3 px-8 rounded-xl shadow-md hover:opacity-90 transition duration-300 transform hover:scale-105">
                            Enregistrer la Mission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>