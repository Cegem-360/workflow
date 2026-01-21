<div>
    {{-- Page header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('My Workflows') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Manage and organize your workflow automations') }}</p>
        </div>
        <a href="{{ route('dashboard.workflows.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('Create Workflow') }}
        </a>
    </div>

    {{-- Filters and search --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            {{-- Search --}}
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="{{ __('Search workflows...') }}"
                        class="w-full pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-violet-500 transition"
                    >
                </div>
            </div>

            {{-- Filter --}}
            <div class="flex gap-2">
                <button wire:click="$set('filter', 'all')"
                    class="px-3 py-2 text-sm font-medium rounded-lg transition {{ $filter === 'all' ? 'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    {{ __('All') }}
                </button>
                <button wire:click="$set('filter', 'active')"
                    class="px-3 py-2 text-sm font-medium rounded-lg transition {{ $filter === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    {{ __('Active') }}
                </button>
                <button wire:click="$set('filter', 'scheduled')"
                    class="px-3 py-2 text-sm font-medium rounded-lg transition {{ $filter === 'scheduled' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    {{ __('Scheduled') }}
                </button>
                <button wire:click="$set('filter', 'webhook')"
                    class="px-3 py-2 text-sm font-medium rounded-lg transition {{ $filter === 'webhook' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    {{ __('Webhook') }}
                </button>
            </div>
        </div>
    </div>

    {{-- Workflows list --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        @if($workflows->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ __('No workflows found') }}</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    @if($search || $filter !== 'all')
                        {{ __('Try adjusting your search or filter criteria.') }}
                    @else
                        {{ __('Create your first workflow to get started.') }}
                    @endif
                </p>
                @if(!$search && $filter === 'all')
                    <a href="{{ route('dashboard.workflows.create') }}"
                        class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Create Workflow') }}
                    </a>
                @endif
            </div>
        @else
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($workflows as $workflow)
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition" wire:key="workflow-{{ $workflow->id }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="w-10 h-10 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $workflow->name }}</h3>
                                    <div class="flex items-center gap-3 mt-1 flex-wrap">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $workflow->nodes_count }} {{ __('nodes') }}
                                        </span>
                                        @if($workflow->description)
                                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                                {{ $workflow->description }}
                                            </span>
                                        @endif
                                        @if($workflow->last_run_at)
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('Last run') }}: {{ $workflow->last_run_at->diffForHumans() }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                {{-- Status badges --}}
                                <div class="hidden sm:flex items-center gap-2">
                                    @if($workflow->is_active)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                    @if($workflow->is_scheduled)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                            {{ $workflow->schedule_description }}
                                        </span>
                                    @endif
                                    @if($workflow->webhook_enabled)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                                            {{ __('Webhook') }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-1">
                                    {{-- Toggle active --}}
                                    <button wire:click="toggleActive({{ $workflow->id }})"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                        title="{{ $workflow->is_active ? __('Deactivate') : __('Activate') }}">
                                        @if($workflow->is_active)
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                    </button>

                                    {{-- Visual Editor --}}
                                    <a href="{{ route('dashboard.workflows.editor', $workflow) }}"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-violet-600 dark:hover:text-violet-400 transition"
                                        title="{{ __('Visual Editor') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <button wire:click="delete({{ $workflow->id }})"
                                        wire:confirm="{{ __('Are you sure you want to delete this workflow?') }}"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400 transition"
                                        title="{{ __('Delete') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($workflows->hasPages())
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $workflows->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
