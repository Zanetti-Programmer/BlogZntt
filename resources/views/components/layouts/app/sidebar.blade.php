<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Starter Kit - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        
        .sidebar-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar-item:hover {
            transform: translateX(8px);
        }
        
        .floating-orb {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .gradient-blur {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
            backdrop-filter: blur(20px);
        }
        
        .menu-icon {
            transition: all 0.3s ease;
        }
        
        .menu-item:hover .menu-icon {
            transform: scale(1.1);
        }
        
        .notification-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body class="h-full bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Moderna -->
        <div class="fixed inset-y-0 left-0 z-50 w-80 transform transition-transform duration-300 ease-in-out lg:translate-x-0">
            <!-- Background com glassmorphism -->
            <div class="absolute inset-0 bg-gradient-to-b from-white/95 via-white/90 to-white/85 backdrop-blur-xl border-r border-white/20"></div>
            
            <!-- Floating orbs decoration -->
            <div class="absolute top-20 right-10 w-32 h-32 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-full floating-orb blur-xl"></div>
            <div class="absolute bottom-32 left-6 w-24 h-24 bg-gradient-to-r from-pink-400/20 to-rose-400/20 rounded-full floating-orb blur-xl" style="animation-delay: -3s;"></div>
            
            <div class="relative flex flex-col h-full">
                <!-- Logo/Header Section -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                Laravel Starter Kit
                            </h1>
                            <p class="text-xs text-gray-500 font-medium">Platform</p>
                        </div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <button class="lg:hidden p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto">
                    
                    <!-- Dashboard -->
                    <a href="#" class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 rounded-2xl hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-indigo-700 group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center group-hover:from-indigo-500 group-hover:to-purple-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0z"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">Dashboard</span>
                            <p class="text-xs text-gray-500 group-hover:text-indigo-500">Visão geral do sistema</p>
                        </div>
                        <span class="notification-pulse absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                    </a>

                    <!-- Repository -->
                    <a href="#" class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 rounded-2xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-700 group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center group-hover:from-emerald-500 group-hover:to-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">Repository</span>
                            <p class="text-xs text-gray-500 group-hover:text-emerald-500">Gerenciar repositórios</p>
                        </div>
                        <div class="ml-auto bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded-full font-medium">24</div>
                    </a>

                    <!-- Documentation -->
                    <a href="#" class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 rounded-2xl hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 hover:text-amber-700 group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-amber-100 to-amber-200 rounded-xl flex items-center justify-center group-hover:from-amber-500 group-hover:to-orange-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">Documentation</span>
                            <p class="text-xs text-gray-500 group-hover:text-amber-500">Guias e referências</p>
                        </div>
                        <div class="ml-auto">
                            <span class="w-2 h-2 bg-amber-400 rounded-full block"></span>
                        </div>
                    </a>

                    <!-- Divider -->
                    <div class="my-6 border-t border-gray-200/50"></div>

                    <!-- Developer Manager (Active) -->
                    <a href="#" class="menu-item sidebar-item flex items-center px-4 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl shadow-lg group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-white/5"></div>
                        <div class="menu-icon w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">Developer Manager</span>
                            <p class="text-xs text-white/80">Gerenciar desenvolvedores</p>
                        </div>
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    </a>

                    <!-- Settings -->
                    <a href="#" class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 rounded-2xl hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 hover:text-gray-800 group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-500/10 to-slate-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-gray-100 to-gray-200 rounded-xl flex items-center justify-center group-hover:from-gray-500 group-hover:to-slate-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">Configurações</span>
                            <p class="text-xs text-gray-500 group-hover:text-gray-600">Ajustes do sistema</p>
                        </div>
                    </a>
                </nav>

                <!-- User Profile Section -->
                <div class="p-4 border-t border-gray-200/50">
                    <div class="flex items-center space-x-3 p-4 rounded-2xl bg-gradient-to-r from-gray-50 to-gray-100 hover:from-gray-100 hover:to-gray-200 transition-all duration-300 cursor-pointer group">
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                GZ
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 truncate text-sm">GUILHERME TALHARI</p>
                            <p class="font-semibold text-gray-900 truncate text-sm">ZANETTI</p>
                            <p class="text-xs text-gray-500">Administrador</p>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="flex gap-2 mt-3">
                        <button class="flex-1 p-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sair
                        </button>
                        <button class="p-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-xl transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-80">
            <!-- Top Navigation -->
            <header class="bg-white/80 backdrop-blur-lg border-b border-gray-200/50 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button class="lg:hidden p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Developer Manager</h1>
                            <p class="text-sm text-gray-500">Gerencie sua equipe de desenvolvimento</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" placeholder="Buscar..." class="w-64 pl-10 pr-4 py-2 bg-gray-100 border-0 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5v5zM4 12l5-5-5 5zm5-5h5v5H9V7z"></path>
                            </svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                <!-- Aqui vai o conteúdo do Developer Manager -->
                <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 p-6">
                    <!-- Seu conteúdo do Developer Manager aqui -->
                    <div class="backdrop-blur-xl bg-white/30 border border-white/20 rounded-3xl p-8 mb-8 shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    👨‍💻 Gerenciador de Desenvolvedores
                                </h1>
                                <p class="text-gray-600 mt-2">Sistema completo para gerenciar sua equipe de desenvolvimento</p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Aqui você coloca o resto do código do Developer Manager -->
                </div>
            </main>
        </div>
    </div>
</body>
</html>