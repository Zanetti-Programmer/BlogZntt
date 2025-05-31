<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    @include('partials.head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --sidebar-width: 320px;
            --animation-duration: 0.3s;
            --blur-strength: 20px;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            overflow-x: hidden;
        }
        
        /* Sidebar animations */
        .sidebar-item {
            transition: all var(--animation-duration) cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar-item:hover {
            transform: translateX(8px);
        }
        
        /* Floating orbs */
        .floating-orb {
            animation: float 6s ease-in-out infinite;
            pointer-events: none;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            50% { 
                transform: translateY(-20px) rotate(180deg); 
            }
        }
        
        /* Glassmorphism effects */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(var(--blur-strength));
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-effect {
            background: rgba(24, 24, 27, 0.95);
            border: 1px solid rgba(63, 63, 70, 0.2);
        }
        
        /* Menu interactions */
        .menu-icon {
            transition: all var(--animation-duration) ease;
        }
        
        .menu-item:hover .menu-icon {
            transform: scale(1.1);
        }
        
        /* Active states */
        .nav-item-active {
            background: linear-gradient(135deg, rgb(99 102 241) 0%, rgb(147 51 234) 100%);
            color: white;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        
        .nav-item-active .menu-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        /* Notification pulse */
        .notification-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Responsive design */
        @media (max-width: 1024px) {
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
                opacity: 0;
                visibility: hidden;
                transition: all var(--animation-duration) ease;
            }
            
            .sidebar-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }
        
        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            .floating-orb,
            .sidebar-item,
            .menu-icon {
                animation: none;
                transition: none;
            }
        }
        
        /* Focus states */
        .focus-ring:focus-visible {
            outline: 2px solid rgb(99 102 241);
            outline-offset: 2px;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar overlay for mobile -->
        <div class="sidebar-overlay lg:hidden" 
             x-data="{ open: false }" 
             :class="{ 'active': open }"
             @click="open = false"
             x-show="open"
             x-transition.opacity></div>
        
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-80 transform transition-transform duration-300 ease-in-out lg:translate-x-0" 
               x-data="{ open: false }" 
               :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
               @click.away="open = false"
               role="navigation"
               aria-label="Main navigation">
            
            <!-- Sidebar background -->
            <div class="absolute inset-0 glass-effect"></div>
            
            <!-- Floating orbs decoration -->
            <div class="absolute top-20 right-10 w-32 h-32 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-full floating-orb blur-xl" aria-hidden="true"></div>
            <div class="absolute bottom-32 left-6 w-24 h-24 bg-gradient-to-r from-pink-400/20 to-rose-400/20 rounded-full floating-orb blur-xl" style="animation-delay: -3s;" aria-hidden="true"></div>
            
            <div class="relative flex flex-col h-full">
                <!-- Header Section -->
                <header class="flex items-center justify-between p-6 border-b border-gray-200/50 dark:border-zinc-700/50">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-3 focus-ring rounded-lg" 
                       wire:navigate
                       aria-label="Go to dashboard">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <x-app-logo class="w-7 h-7 text-white" />
                        </div>
                        <div>
                            <h1 class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                {{ config('app.name', 'Laravel') }}
                            </h1>
                            <p class="text-xs text-gray-500 dark:text-zinc-400 font-medium">{{ __('Platform') }}</p>
                        </div>
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button @click="open = !open" 
                            class="lg:hidden p-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 transition-colors focus-ring"
                            aria-label="Toggle navigation menu"
                            :aria-expanded="open">
                        <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </header>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto" role="navigation" aria-label="Primary navigation">
                    
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       wire:navigate
                       class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 dark:text-zinc-300 rounded-2xl hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/20 dark:hover:to-purple-900/20 hover:text-indigo-700 dark:hover:text-indigo-300 group relative overflow-hidden focus-ring {{ request()->routeIs('dashboard') ? 'nav-item-active' : '' }}"
                       aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
                        
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center group-hover:from-indigo-500 group-hover:to-purple-500 group-hover:text-white transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0z"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">{{ __('Dashboard') }}</span>
                            <p class="text-xs text-gray-500 dark:text-zinc-400 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 {{ request()->routeIs('dashboard') ? 'text-white/80' : '' }}">
                                {{ __('Visão geral do sistema') }}
                            </p>
                        </div>
                        @if(request()->routeIs('dashboard'))
                            <span class="notification-pulse absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                        @endif
                    </a>

                    <!-- Repository -->
                    <a href="https://github.com/laravel/livewire-starter-kit" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 dark:text-zinc-300 rounded-2xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 dark:hover:from-emerald-900/20 dark:hover:to-teal-900/20 hover:text-emerald-700 dark:hover:text-emerald-300 group relative overflow-hidden focus-ring"
                       aria-label="View GitHub repository (opens in new tab)">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
                        
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-emerald-100 to-emerald-200 dark:from-emerald-900/50 dark:to-emerald-800/50 rounded-xl flex items-center justify-center group-hover:from-emerald-500 group-hover:to-teal-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4 flex-1">
                            <span class="font-semibold">{{ __('Repository') }}</span>
                            <p class="text-xs text-gray-500 dark:text-zinc-400 group-hover:text-emerald-500 dark:group-hover:text-emerald-400">
                                {{ __('Gerenciar repositórios') }}
                            </p>
                        </div>
                        <div class="ml-auto bg-emerald-100 dark:bg-emerald-900/20 text-emerald-800 dark:text-emerald-300 text-xs px-2 py-1 rounded-full font-medium">24</div>
                    </a>

                    <!-- Documentation -->
                    <a href="https://laravel.com/docs/starter-kits#livewire" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 dark:text-zinc-300 rounded-2xl hover:bg-gradient-to-r hover:from-amber-50 hover:to-orange-50 dark:hover:from-amber-900/20 dark:hover:to-orange-900/20 hover:text-amber-700 dark:hover:text-amber-300 group relative overflow-hidden focus-ring"
                       aria-label="View documentation (opens in new tab)">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
                        
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-amber-100 to-amber-200 dark:from-amber-900/50 dark:to-amber-800/50 rounded-xl flex items-center justify-center group-hover:from-amber-500 group-hover:to-orange-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4 flex-1">
                            <span class="font-semibold">{{ __('Documentation') }}</span>
                            <p class="text-xs text-gray-500 dark:text-zinc-400 group-hover:text-amber-500 dark:group-hover:text-amber-400">
                                {{ __('Guias e referências') }}
                            </p>
                        </div>
                        <div class="ml-auto">
                            <span class="w-2 h-2 bg-amber-400 rounded-full block"></span>
                        </div>
                    </a>

                    <!-- Divider -->
                    <hr class="my-6 border-gray-200/50 dark:border-zinc-700/50" />

                    <!-- Developer Manager (Active Example) -->
                    <a href="{{ route('developers') }}" 
                       class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 dark:text-zinc-300 rounded-2xl hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 dark:hover:from-slate-900/20 dark:hover:to-gray-900/20 hover:text-gray-800 dark:hover:text-gray-200 group relative overflow-hidden focus-ring {{ request()->routeIs('developers') ? 'nav-item-active' : '' }}">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-500/10 to-slate-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
                        
                        <div class="menu-icon w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">{{ __('Developer Manager') }}</span>
                            <p class="text-xs text-white/80">{{ __('Gerenciar desenvolvedores') }}</p>
                        </div>
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('settings.profile') }}" 
                       wire:navigate
                       class="menu-item sidebar-item flex items-center px-4 py-4 text-gray-700 dark:text-zinc-300 rounded-2xl hover:bg-gradient-to-r hover:from-slate-50 hover:to-gray-50 dark:hover:from-slate-900/20 dark:hover:to-gray-900/20 hover:text-gray-800 dark:hover:text-gray-200 group relative overflow-hidden focus-ring {{ request()->routeIs('settings.*') ? 'nav-item-active' : '' }}"
                       aria-current="{{ request()->routeIs('settings.*') ? 'page' : 'false' }}">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-500/10 to-slate-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
                        
                        <div class="menu-icon w-10 h-10 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-900/50 dark:to-gray-800/50 rounded-xl flex items-center justify-center group-hover:from-gray-500 group-hover:to-slate-500 group-hover:text-white transition-all duration-300 {{ request()->routeIs('settings.*') ? 'bg-white/20 text-white' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="relative ml-4">
                            <span class="font-semibold">{{ __('Configurações') }}</span>
                            <p class="text-xs text-gray-500 dark:text-zinc-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 {{ request()->routeIs('settings.*') ? 'text-white/80' : '' }}">
                                {{ __('Ajustes do sistema') }}
                            </p>
                        </div>
                    </a>
                </nav>

                <!-- User Profile Section -->
                <footer class="p-4 border-t border-gray-200/50 dark:border-zinc-700/50">
                    <flux:dropdown position="top" align="start" class="w-full">
                        <button class="flex items-center space-x-3 p-4 rounded-2xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-zinc-800 dark:to-zinc-700 hover:from-gray-100 hover:to-gray-200 dark:hover:from-zinc-700 dark:hover:to-zinc-600 transition-all duration-300 group w-full focus-ring"
                                aria-label="User menu">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    {{ auth()->user()->initials() }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white dark:border-zinc-700 rounded-full" 
                                     aria-label="Online status"></div>
                            </div>
                            <div class="flex-1 min-w-0 text-left">
                                <p class="font-semibold text-gray-900 dark:text-zinc-100 truncate text-sm">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-zinc-400 truncate">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 dark:text-zinc-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <flux:menu class="w-[280px]">
                            <flux:menu.radio.group>
                                <div class="p-0 text-sm font-normal">
                                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                            <span class="flex h-full w-full items-center justify-center rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold">
                                                {{ auth()->user()->initials() }}
                                            </span>
                                        </span>
                                        <div class="grid flex-1 text-start text-sm leading-tight">
                                            <span class="truncate font-semibold text-gray-900 dark:text-zinc-100">
                                                {{ auth()->user()->name }}
                                            </span>
                                            <span class="truncate text-xs text-gray-500 dark:text-zinc-400">
                                                {{ auth()->user()->email }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <flux:menu.radio.group>
                                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                                    {{ __('Settings') }}
                                </flux:menu.item>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" 
                                              type="submit" 
                                              icon="arrow-right-start-on-rectangle" 
                                              class="w-full text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                    {{ __('Log Out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                    
                    <!-- Quick Actions (from original layout) -->
                    <div class="flex gap-2 mt-3">
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full p-3 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-sm font-medium focus-ring">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                {{ __('Sair') }}
                            </button>
                        </form>
                        <a href="{{ route('settings.profile') }}" 
                           wire:navigate
                           class="p-3 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-900/20 dark:hover:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl transition-all duration-300 focus-ring">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>
                    </div>
                </footer>
            </div>
        </aside>

        <!-- Mobile Header -->
        <header class="lg:hidden bg-white/80 dark:bg-zinc-900/80 backdrop-blur-lg border-b border-gray-200/50 dark:border-zinc-700/50" 
                x-data="{ open: false }">
            <div class="flex items-center justify-between p-4">
                <button @click="open = !open" 
                        class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 transition-colors focus-ring"
                        aria-label="Toggle navigation menu"
                        :aria-expanded="open">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <flux:dropdown position="top" align="end">
                    <flux:profile
                        :initials="auth()->user()->initials()"
                        icon-trailing="chevron-down"
                        class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white focus-ring"
                    />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span class="flex h-full w-full items-center justify-center rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold">
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>
                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold text-gray-900 dark:text-zinc-100">
                                            {{ auth()->user()->name }}
                                        </span>
                                        <span class="truncate text-xs text-gray-500 dark:text-zinc-400">
                                            {{ auth()->user()->email }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                                {{ __('Settings') }}
                            </flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" 
                                          type="submit" 
                                          icon="arrow-right-start-on-rectangle" 
                                          class="w-full text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-hidden lg:ml-80" role="main">
            {{ $slot }}
        </main>
    </div>

    @fluxScripts
</body>
</html>