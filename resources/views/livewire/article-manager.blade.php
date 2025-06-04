<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-2 lg:p-4"
     x-data="articleManager()" 
     x-on:keydown.window="handleKeyboardShortcuts($event)"
     wire:loading.class="opacity-75">
    
    <!-- Estilos CSS integrados MELHORADOS -->
    <style>
        /* Animações */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        @keyframes pulse-success {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes slideInFromTop {
            0% { transform: translateY(-100%); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes slideInFromRight {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        /* Classes utilitárias */
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
        
        .animate-pulse-success {
            animation: pulse-success 2s ease-in-out;
        }
        
        .animate-slide-in {
            animation: slideInFromTop 0.3s ease-out;
        }
        
        .animate-slide-in-right {
            animation: slideInFromRight 0.3s ease-out;
        }
        
        /* Scroll customizado melhorado */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        
        /* Upload zone melhorada */
        .upload-zone {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .upload-zone:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .upload-zone.dragover {
            border-color: #3b82f6 !important;
            background-color: #eff6ff !important;
            transform: scale(1.02);
        }
        
        /* Estados de validação */
        .input-valid {
            border-color: #10b981 !important;
            background-color: #f0fdf4 !important;
        }
        
        .input-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }
        
        /* Botões melhorados */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        /* Line clamp para textos */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Melhorias para mobile */
        @media (max-width: 640px) {
            .mobile-stack {
                flex-direction: column;
            }
            
            .mobile-full {
                width: 100%;
            }
            
            .mobile-text-xs {
                font-size: 0.7rem;
            }
        }
        
        /* Efeitos hover melhorados */
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Gradientes personalizados */
        .gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-purple {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        /* Efeito glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Notificações melhoradas -->
        @if (session()->has('message'))
            <div class="fixed top-4 right-4 z-50 animate-slide-in-right" 
                 x-data="{ show: true }" 
                 x-show="show" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-full"
                 x-init="setTimeout(() => show = false, 5000)">
                
                <div class="bg-white border-l-4 border-green-500 rounded-lg shadow-xl p-4 max-w-md backdrop-blur-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center animate-pulse-success">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-semibold text-gray-900">Sucesso!</p>
                            <p class="text-sm text-gray-600 mt-1">{{ session('message') }}</p>
                        </div>
                        <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="fixed top-4 right-4 z-50 animate-slide-in-right" 
                 x-data="{ show: true }" 
                 x-show="show" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                
                <div class="bg-white border-l-4 border-red-500 rounded-lg shadow-xl p-4 max-w-md backdrop-blur-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-semibold text-gray-900">Erro!</p>
                            <div class="mt-1">
                                @foreach ($errors->all() as $error)
                                    <p class="text-sm text-gray-600">• {{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Header melhorado -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl hover-lift">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                    Gerenciador de Artigos
                </h1>
                <div class="flex items-center justify-center gap-3 text-sm text-slate-600 mt-2">
                    <span>Bem-vindo, <span class="font-semibold text-blue-600">Zanetti-Programmer</span>!</span>
                    <span class="w-1 h-1 bg-slate-400 rounded-full"></span>
                    <time>{{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</time>
                    <span class="w-1 h-1 bg-slate-400 rounded-full"></span>
                    <span class="text-green-600 font-semibold">{{ $articles->count() }} artigos</span>
                </div>
            </div>
        </div>

        <!-- Form Card melhorado -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden hover-lift">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $modoEdicao ? 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' : 'M12 4v16m8-8H4' }}"></path>
                            </svg>
                        </div>
                        {{ $modoEdicao ? 'Editar Artigo' : 'Novo Artigo' }}
                    </h2>
                    
                    <!-- Atalhos de teclado -->
                    <div class="hidden md:flex items-center gap-4 text-xs text-white/70">
                        <span><kbd class="bg-white/20 px-2 py-1 rounded text-xs">Ctrl+S</kbd> Salvar</span>
                        <span><kbd class="bg-white/20 px-2 py-1 rounded text-xs">Ctrl+N</kbd> Novo</span>
                        <span><kbd class="bg-white/20 px-2 py-1 rounded text-xs">Esc</kbd> Cancelar</span>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="{{ $modoEdicao ? 'atualizar' : 'salvar' }}" 
                  class="p-6 space-y-6"
                  x-on:submit="handleFormSubmit">
                
                <!-- Grid principal otimizado -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Título (2 colunas) -->
                    <div class="lg:col-span-2 group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Título <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   wire:model.live.debounce.300ms="titulo" 
                                   placeholder="Digite um título atrativo para o artigo..." 
                                   maxlength="255"
                                   x-data="{ 
                                       valid: true,
                                       count: 0
                                   }"
                                   x-on:input="
                                       valid = $el.value.length >= 3;
                                       count = $el.value.length;
                                   "
                                   :class="{
                                       'input-valid': valid && count > 0,
                                       'input-invalid': !valid && count > 0
                                   }"
                                   class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 outline-none text-slate-800 placeholder-slate-400 {{ $errors->has('titulo') ? 'input-invalid' : '' }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 gap-3">
                                <span class="text-xs text-slate-400 hidden sm:block" x-text="count + '/255'"></span>
                                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a.997.997 0 01-1.414 0l-7-7A1.997 1.997 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('titulo') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm animate-shake">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Data de publicação -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Data de Publicação</label>
                        <div class="relative">
                            <input type="datetime-local" 
                                   wire:model.defer="data_publicacao" 
                                   value="{{ $data_publicacao ?? now()->setTimezone('America/Sao_Paulo')->format('Y-m-d\TH:i') }}"
                                   class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 outline-none text-slate-800 {{ $errors->has('data_publicacao') ? 'input-invalid' : '' }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('data_publicacao') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm animate-shake">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Editor de conteúdo melhorado -->
                <div class="group">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Conteúdo <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea wire:model.live.debounce.500ms="conteudo" 
                                  placeholder="Escreva o conteúdo completo do seu artigo aqui..." 
                                  rows="6" 
                                  x-data="{ count: 0 }"
                                  x-on:input="count = $el.value.length"
                                  class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 outline-none text-slate-800 placeholder-slate-400 resize-none {{ $errors->has('conteudo') ? 'input-invalid' : '' }}"></textarea>
                        <div class="absolute bottom-3 right-4 text-xs text-slate-400 bg-white/80 px-2 py-1 rounded" x-text="count + ' caracteres'"></div>
                    </div>
                    @error('conteudo') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm animate-shake">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Grid para upload e desenvolvedores -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Upload de imagem melhorado -->
                    <div class="group" x-data="imageUpload()">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Imagem de Capa
                            <span class="text-xs text-slate-500 font-normal">(Máximo 2MB - PNG, JPG, WebP)</span>
                        </label>
                        
                        <div class="upload-zone border-2 border-dashed border-slate-300 rounded-xl bg-slate-50/50 overflow-hidden"
                             :class="{
                                 'dragover': isDragOver,
                                 'input-valid': isValid && hasFile,
                                 'input-invalid': !isValid && hasFile,
                                 'border-blue-400 bg-blue-50': isDragOver
                             }"
                             @dragover.prevent="isDragOver = true"
                             @dragleave.prevent="isDragOver = false"
                             @drop.prevent="handleDrop($event)">
                            
                            <input type="file" 
                                   wire:model="novaCapa" 
                                   accept="image/*"
                                   @change="handleFileSelect($event)"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <!-- Preview da imagem -->
                            @if($novaCapa)
                                <div class="relative aspect-video w-full max-w-sm mx-auto">
                                    <img src="{{ $novaCapa->temporaryUrl() }}" 
                                         class="w-full h-full object-cover rounded-lg"
                                         loading="lazy"
                                         decoding="async"
                                         alt="Preview da nova imagem">
                                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity rounded-lg">
                                        <span class="text-white text-sm font-medium bg-black bg-opacity-50 px-3 py-1 rounded-full">Trocar Imagem</span>
                                    </div>
                                    <div class="absolute top-2 right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            @elseif($capa)
                                <div class="relative aspect-video w-full max-w-sm mx-auto">
                                    <img src="{{ asset('storage/' . $capa) }}" 
                                         class="w-full h-full object-cover rounded-lg opacity-80"
                                         loading="lazy"
                                         decoding="async"
                                         alt="Imagem atual do artigo">
                                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center rounded-lg">
                                        <span class="text-white text-sm font-medium bg-black bg-opacity-50 px-3 py-1 rounded-full">Trocar Imagem</span>
                                    </div>
                                    <div class="absolute top-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full shadow-lg">
                                        Atual
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-8" x-show="!hasFile">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-200 transition-colors">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm font-semibold text-slate-700 mb-1">Clique ou arraste uma imagem</div>
                                        <div class="text-xs text-slate-500">PNG, JPG, WebP até 2MB</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Informações do arquivo -->
                        <div x-show="fileInfo" class="mt-2 text-xs text-slate-600 bg-slate-50 px-3 py-2 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span x-text="fileInfo?.name"></span>
                                <span x-text="fileInfo?.size"></span>
                            </div>
                        </div>
                        
                        <!-- Mensagens de erro -->
                        <div x-show="errorMessage" class="mt-2 text-red-600 text-xs animate-shake" x-text="errorMessage"></div>
                        
                        @error('novaCapa') 
                            <div class="mt-2 text-red-600 text-sm animate-shake">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Seleção de desenvolvedores melhorada -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Desenvolvedores Associados
                            <span class="text-xs text-slate-500 font-normal">(Ctrl+Click para múltipla seleção)</span>
                        </label>
                        <div class="relative">
                            <select wire:model="desenvolvedores" 
                                    multiple 
                                    size="4"
                                    class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 outline-none text-slate-800 {{ $errors->has('desenvolvedores') ? 'input-invalid' : '' }}">
                                @foreach($allDevelopers as $dev)
                                    <option value="{{ $dev->id }}" class="py-2 px-2 hover:bg-blue-100 cursor-pointer">
                                        {{ $dev->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Tags dos desenvolvedores selecionados -->
                        @if(count($desenvolvedores) > 0)
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach($allDevelopers->whereIn('id', $desenvolvedores) as $dev)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full border border-blue-200 hover:bg-blue-200 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        {{ $dev->nome }}
                                        <button type="button" 
                                                wire:click="removeDeveloper({{ $dev->id }})" 
                                                class="hover:text-blue-600 ml-1 transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="mt-3 text-xs text-slate-500 bg-slate-50 px-3 py-2 rounded-lg">
                                Nenhum desenvolvedor selecionado
                            </div>
                        @endif
                        
                        @error('desenvolvedores') 
                            <div class="mt-2 text-red-600 text-sm animate-shake">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Botões de ação melhorados -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-slate-200">
                    <!-- Botão principal -->
                    <button type="submit" 
                            wire:loading.attr="disabled"
                            class="flex-1 btn-primary text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover-lift disabled:transform-none disabled:opacity-50 flex items-center justify-center gap-2">
                        <div wire:loading wire:target="{{ $modoEdicao ? 'atualizar' : 'salvar' }}" class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                        <svg wire:loading.remove wire:target="{{ $modoEdicao ? 'atualizar' : 'salvar' }}" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $modoEdicao ? 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15' : 'M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4' }}"></path>
                        </svg>
                        <span wire:loading.remove wire:target="{{ $modoEdicao ? 'atualizar' : 'salvar' }}">
                            {{ $modoEdicao ? 'Atualizar Artigo' : 'Publicar Artigo' }}
                        </span>
                        <span wire:loading wire:target="{{ $modoEdicao ? 'atualizar' : 'salvar' }}">
                            {{ $modoEdicao ? 'Atualizando...' : 'Publicando...' }}
                        </span>
                    </button>

                    <!-- Botão cancelar (apenas no modo edição) -->
                    @if ($modoEdicao)
                        <button type="button" 
                                wire:click="resetForm" 
                                class="px-6 py-3 bg-slate-500 hover:bg-slate-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover-lift flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <!-- Lista de artigos melhorada -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden hover-lift">
            <div class="bg-gradient-to-r from-slate-800 to-slate-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        Lista de Artigos
                        @if($articles->count() > 0)
                            <span class="bg-white/20 text-sm px-3 py-1 rounded-full">{{ $articles->count() }}</span>
                        @endif
                    </h2>
                    
                    <!-- Indicador de status -->
                    <div class="flex items-center gap-2 text-white/80 text-sm">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span>Online</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabela responsiva melhorada -->
            <div class="max-h-96 overflow-y-auto custom-scrollbar" wire:loading.class="opacity-50">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[900px]">
                        <thead class="bg-slate-50 border-b border-slate-200 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-20">Capa</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Título</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider hidden md:table-cell">Desenvolvedores</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-32">Data</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-24">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-32">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($articles as $article)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200 group">
                                    <!-- Capa melhorada -->
                                    <td class="px-4 py-3">
                                        @if ($article->capa)
                                            <div class="relative w-16 h-16 rounded-xl overflow-hidden shadow-md group-hover:shadow-lg transition-shadow hover-lift">
                                                <img src="{{ asset('storage/' . $article->capa) }}" 
                                                     class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-110"
                                                     loading="lazy"
                                                     decoding="async"
                                                     alt="{{ $article->titulo }}">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-slate-200 to-slate-300 rounded-xl flex items-center justify-center hover-lift">
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <!-- Título e prévia melhorados -->
                                    <td class="px-4 py-3">
                                        <div class="space-y-1">
                                            <div class="font-semibold text-slate-900 line-clamp-2 hover:text-blue-600 transition-colors cursor-pointer" 
                                                 title="{{ $article->titulo }}">
                                                {{ $article->titulo }}
                                            </div>
                                            <div class="text-xs text-slate-500 line-clamp-2 hidden sm:block">
                                                {{ Str::limit(strip_tags($article->conteudo), 80) }}
                                            </div>
                                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                                <span>{{ Str::length($article->conteudo) }} caracteres</span>
                                                <span>•</span>
                                                <span>ID: {{ $article->id }}</span>
                                                <span>•</span>
                                                <span>{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Desenvolvedores melhorados -->
                                    <td class="px-4 py-3 hidden md:table-cell">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($article->developers->take(2) as $dev)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200 transition-colors" 
                                                      title="{{ $dev->nome }}">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    {{ Str::limit($dev->nome, 10) }}
                                                </span>
                                            @endforeach
                                            @if($article->developers->count() > 2)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200 hover:bg-slate-200 transition-colors" 
                                                      title="{{ $article->developers->pluck('nome')->join(', ') }}">
                                                    +{{ $article->developers->count() - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- Data melhorada -->
                                    <td class="px-4 py-3">
                                        <div class="space-y-1">
                                            <div class="text-sm font-medium text-slate-900">
                                                {{ \Carbon\Carbon::parse($article->data_publicacao)->setTimezone('America/Sao_Paulo')->format('d/m/Y') }}
                                            </div>
                                            <div class="text-xs text-slate-500">
                                                {{ \Carbon\Carbon::parse($article->data_publicacao)->setTimezone('America/Sao_Paulo')->format('H:i') }}
                                            </div>
                                            <div class="text-xs text-slate-400">
                                                {{ \Carbon\Carbon::parse($article->data_publicacao)->diffForHumans() }}
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Status melhorado -->
                                    <td class="px-4 py-3">
                                        @php
                                            $isPublished = \Carbon\Carbon::parse($article->data_publicacao)->isPast();
                                        @endphp
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium border {{ $isPublished ? 'bg-green-100 text-green-800 border-green-200' : 'bg-yellow-100 text-yellow-800 border-yellow-200' }}">
                                            <div class="w-2 h-2 rounded-full {{ $isPublished ? 'bg-green-500 animate-pulse' : 'bg-yellow-500' }}"></div>
                                            {{ $isPublished ? 'Publicado' : 'Agendado' }}
                                        </span>
                                    </td>
                                    
                                    <!-- Ações melhoradas -->
                                    <td class="px-4 py-3">
                                        <div class="flex gap-1">
                                            <button wire:click="editar({{ $article->id }})" 
                                                    title="Editar artigo"
                                                    class="inline-flex items-center px-2 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-lg transition-all duration-200 hover:shadow-md hover-lift">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="hidden lg:inline ml-1">Editar</span>
                                            </button>
                                            
                                            <button wire:click="deletar({{ $article->id }})" 
                                                    wire:confirm="Tem certeza que deseja excluir o artigo '{{ $article->titulo }}'? Esta ação não pode ser desfeita."
                                                    title="Excluir artigo"
                                                    class="inline-flex items-center px-2 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-lg transition-all duration-200 hover:shadow-md hover-lift">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="hidden lg:inline ml-1">Excluir</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-center">
                                        <div class="space-y-4">
                                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-700 mb-2">Nenhum artigo encontrado</h3>
                                                <p class="text-slate-500 text-sm mb-4">
                                                    Comece criando seu primeiro artigo usando o formulário acima.
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($articles->count() > 5)
                <div class="bg-slate-50 border-t border-slate-200 px-6 py-3 text-center">
                    <div class="text-xs text-slate-500 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                        </svg>
                        Role para ver mais artigos ({{ $articles->count() }} total)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Loading Overlay Global Melhorado -->
    <div wire:loading.flex wire:target="salvar,atualizar,deletar" 
         class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-8 shadow-2xl max-w-sm mx-4 animate-slide-in">
            <div class="text-center space-y-4">
                <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
                <div>
                    <h3 class="font-semibold text-slate-900 mb-2">Processando Operação</h3>
                    <p class="text-sm text-slate-600">Por favor, aguarde um momento...</p>
                    <div class="mt-3 text-xs text-slate-400">
                        <span wire:loading wire:target="salvar">Salvando artigo...</span>
                        <span wire:loading wire:target="atualizar">Atualizando artigo...</span>
                        <span wire:loading wire:target="deletar">Excluindo artigo...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript melhorados -->
    <script>
        // Função principal do gerenciador de artigos
        function articleManager() {
            return {
                init() {
                    this.setupKeyboardShortcuts();
                    console.log('Article Manager initialized');
                },
                
                // Configurar atalhos de teclado
                setupKeyboardShortcuts() {
                    document.addEventListener('keydown', (e) => this.handleKeyboardShortcuts(e));
                },
                
                // Manipular atalhos de teclado
                handleKeyboardShortcuts(event) {
                    // Ctrl+S para salvar
                    if (event.ctrlKey && event.key === 's') {
                        event.preventDefault();
                        const submitButton = document.querySelector('button[type="submit"]');
                        if (submitButton) {
                            submitButton.click();
                        }
                    }
                    
                    // Ctrl+N para novo artigo
                    if (event.ctrlKey && event.key === 'n') {
                        event.preventDefault();
                        this.$wire.resetForm();
                    }
                    
                    // Escape para cancelar
                    if (event.key === 'Escape') {
                        const cancelButton = document.querySelector('button[wire\\:click="resetForm"]');
                        if (cancelButton) {
                            cancelButton.click();
                        }
                    }
                },
                
                // Manipular envio do formulário
                handleFormSubmit() {
                    console.log('Form submitted');
                }
            }
        }
        
        // Função para upload de imagem melhorada
        function imageUpload() {
            return {
                isDragOver: false,
                isValid: true,
                hasFile: false,
                fileInfo: null,
                errorMessage: '',
                maxSize: 2048000, // 2MB em bytes
                allowedTypes: ['image/jpeg', 'image/png', 'image/webp'],
                
                // Manipular drop de arquivo
                handleDrop(event) {
                    this.isDragOver = false;
                    const files = event.dataTransfer.files;
                    if (files.length > 0) {
                        this.validateAndSetFile(files[0]);
                    }
                },
                
                // Manipular seleção de arquivo
                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.validateAndSetFile(file);
                    }
                },
                
                // Validar e definir arquivo
                validateAndSetFile(file) {
                    this.clearError();
                    
                    // Validar tipo de arquivo
                    if (!this.allowedTypes.includes(file.type)) {
                        this.setError('Tipo de arquivo não permitido. Use apenas JPG, PNG ou WebP.');
                        return;
                    }
                    
                    // Validar tamanho
                    if (file.size > this.maxSize) {
                        this.setError(`Arquivo muito grande. Tamanho máximo: ${this.formatFileSize(this.maxSize)}.`);
                        return;
                    }
                    
                    this.setSuccess(file);
                },
                
                // Definir sucesso
                setSuccess(file) {
                    this.isValid = true;
                    this.hasFile = true;
                    this.fileInfo = {
                        name: file.name,
                        size: this.formatFileSize(file.size),
                        type: file.type
                    };
                    this.errorMessage = '';
                },
                
                // Definir erro
                setError(message) {
                    this.isValid = false;
                    this.errorMessage = message;
                    this.hasFile = false;
                    this.fileInfo = null;
                    
                    // Limpar input
                    const input = document.querySelector('input[type="file"]');
                    if (input) {
                        input.value = '';
                    }
                },
                
                // Limpar erro
                clearError() {
                    this.errorMessage = '';
                    this.isValid = true;
                },
                
                // Formatar tamanho do arquivo
                formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
                }
            }
        }
        
        // Eventos globais
        document.addEventListener('DOMContentLoaded', function() {
            // Melhorar acessibilidade
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.group')?.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.closest('.group')?.classList.remove('focused');
                });
            });
        });
    </script>
</div>