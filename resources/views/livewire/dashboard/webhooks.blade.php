<div>
    {{-- Page header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Webhooks') }}</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Configure and manage your workflow webhooks') }}</p>
    </div>

    {{-- Active webhooks --}}
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Active Webhooks') }}</h2>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            @if($webhookWorkflows->isEmpty())
                <div class="p-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ __('No active webhooks') }}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Enable webhooks on your workflows to trigger them via HTTP requests.') }}</p>
                </div>
            @else
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($webhookWorkflows as $workflow)
                        <div class="p-4" wire:key="webhook-{{ $workflow->id }}">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-white">{{ $workflow->name }}</h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            @if($workflow->is_active)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                                    {{ __('Active') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                                    {{ __('Inactive') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button wire:click="regenerateToken({{ $workflow->id }})"
                                        wire:confirm="{{ __('Are you sure you want to regenerate this webhook token? The old URL will stop working.') }}"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                        title="{{ __('Regenerate Token') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                    </button>
                                    <button wire:click="toggleWebhook({{ $workflow->id }})"
                                        class="p-2 rounded-lg text-gray-500 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-600 dark:hover:text-red-400 transition"
                                        title="{{ __('Disable Webhook') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Webhook URL --}}
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Webhook URL') }}</label>
                                <div class="flex items-center gap-2">
                                    <code class="flex-1 text-sm text-gray-900 dark:text-white font-mono break-all">{{ $workflow->webhook_url }}</code>
                                    <button
                                        x-data
                                        @click="navigator.clipboard.writeText('{{ $workflow->webhook_url }}'); $dispatch('notify', { message: '{{ __('Copied to clipboard') }}' })"
                                        class="shrink-0 p-2 rounded-lg text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-600 transition"
                                        title="{{ __('Copy to clipboard') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Enable webhooks on other workflows --}}
    @if($otherWorkflows->isNotEmpty())
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Enable Webhooks') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ __('Select workflows to enable webhook triggering.') }}</p>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($otherWorkflows as $workflow)
                        <div class="p-4 flex items-center justify-between" wire:key="other-{{ $workflow->id }}">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">{{ $workflow->name }}</h3>
                                    @if($workflow->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                            {{ __('Active') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button wire:click="toggleWebhook({{ $workflow->id }})"
                                class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-amber-600 hover:bg-amber-50 dark:text-amber-400 dark:hover:bg-amber-900/30 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ __('Enable') }}
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
