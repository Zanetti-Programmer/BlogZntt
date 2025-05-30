<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6">
    <!-- Header com gradiente e efeito glassmorphism -->
    <div class="backdrop-blur-xl bg-white/30 border border-white/20 rounded-3xl p-8 mb-8 shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    {{ $modoEdicao ? '✏️ Editar Desenvolvedor' : '👨‍💻 Novo Desenvolvedor' }}
                </h1>
                <p class="text-gray-600 mt-2">Gerencie sua equipe de desenvolvimento com estilo</p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Formulário Moderno -->
        <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
            <form wire:submit.prevent="{{'teste' ? 'atualizar' : 'salvar' }}" class="space-y-6">
                
                <!-- Campo Nome com ícone -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Nome Completo
                    </label>
                    <input type="text" 
                           wire:model.defer="nome" 
                           placeholder="Digite o nome do desenvolvedor" 
                           class="w-full p-4 bg-white/60 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 backdrop-blur-sm group-hover:bg-white/80">
                    @error('nome') 
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo Email com ícone -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Profissional
                    </label>
                    <input type="email" 
                           wire:model.defer="email" 
                           placeholder="exemplo@empresa.com" 
                           class="w-full p-4 bg-white/60 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 backdrop-blur-sm group-hover:bg-white/80">
                    @error('email') 
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo Biografia -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Biografia Profissional
                    </label>
                    <textarea wire:model.defer="biografia" 
                              placeholder="Conte um pouco sobre a experiência e especialidades..." 
                              rows="4"
                              class="w-full p-4 bg-white/60 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 backdrop-blur-sm group-hover:bg-white/80 resize-none"></textarea>
                    @error('biografia') 
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Upload de Foto com preview modernizado -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Foto de Perfil
                    </label>
                    
                    <div class="flex items-center gap-6">
                        @if ($foto)
                            <div class="relative group/photo">
                                <img src="{{ asset('storage/' . $foto) }}" 
                                     alt="Foto atual" 
                                     class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg group-hover/photo:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover/photo:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <input type="file" 
                                   wire:model="novaFoto" 
                                   id="foto-upload"
                                   class="hidden">
                            <label for="foto-upload" 
                                   class="cursor-pointer inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl hover:from-pink-600 hover:to-rose-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Escolher Foto
                            </label>
                        </div>
                    </div>
                    
                    @error('novaFoto') 
                        <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Botões de Ação -->
                <div class="flex gap-4 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-4 rounded-2xl font-semibold hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $modoEdicao ? 'Atualizar Desenvolvedor' : 'Adicionar Desenvolvedor' }}
                    </button>

                    @if ($modoEdicao)
                        <button type="button" 
                                wire:click="resetForm" 
                                class="px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <!-- Lista de Desenvolvedores -->
        <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent flex items-center gap-3">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Equipe de Desenvolvimento
                </h2>
                <div class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-semibold">
                    {{ count($developers) }} {{ count($developers) == 1 ? 'Desenvolvedor' : 'Desenvolvedores' }}
                </div>
            </div>

            @if(count($developers) > 0)
                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    @foreach ($developers as $dev)
                        <div class="bg-white/60 backdrop-blur-sm border border-white/40 rounded-2xl p-6 hover:bg-white/80 transition-all duration-300 transform hover:scale-[1.02] shadow-lg">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    @if ($dev->foto)
                                        <img src="{{ asset('storage/' . $dev->foto) }}" 
                                             class="w-16 h-16 rounded-full object-cover border-3 border-white shadow-lg">
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 border-2 border-white rounded-full"></div>
                                    @else
                                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-xl border-3 border-white shadow-lg">
                                            {{ substr($dev->nome, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg text-gray-900 truncate">{{ $dev->nome }}</h3>
                                    <p class="text-gray-600 text-sm truncate flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $dev->email }}
                                    </p>
                                    @if($dev->biografia)
                                        <p class="text-gray-500 text-xs mt-1 truncate">{{ $dev->biografia }}</p>
                                    @endif
                                </div>
                                
                                <div class="flex gap-2">
                                    <button wire:click="editar({{ $dev->id }})" 
                                            class="p-3 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="deletar({{ $dev->id }})" 
                                            class="p-3 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">Nenhum desenvolvedor cadastrado</h3>
                    <p class="text-gray-500">Adicione o primeiro desenvolvedor da sua equipe!</p>
                </div>
            @endif
        </div>
    </div>
</div>