<div>
    {{-- Page header --}}
    <div class="mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard.workflows') }}"
                class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Create Workflow') }}</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Build a new workflow automation') }}</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form wire:submit="create" class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
            {{-- Basic info --}}
            <div class="p-6 space-y-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Basic Information') }}</h2>

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Workflow Name') }} <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-violet-500 transition"
                        placeholder="{{ __('Enter workflow name...') }}"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Description') }}
                    </label>
                    <textarea
                        id="description"
                        wire:model="description"
                        rows="3"
                        class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-violet-500 transition resize-none"
                        placeholder="{{ __('Describe what this workflow does...') }}"
                    ></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Settings --}}
            <div class="p-6 space-y-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Settings') }}</h2>

                {{-- Active toggle --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Active') }}</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Enable this workflow to run') }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="isActive" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-violet-600"></div>
                    </label>
                </div>

                {{-- Schedule toggle --}}
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Scheduled') }}</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Run this workflow on a schedule') }}</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="isScheduled" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    @if($isScheduled)
                        <div>
                            <label for="scheduleCron" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Schedule Frequency') }}
                            </label>
                            <select
                                id="scheduleCron"
                                wire:model="scheduleCron"
                                class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 transition"
                            >
                                <option value="">{{ __('Select frequency...') }}</option>
                                <option value="* * * * *">{{ __('Every minute') }}</option>
                                <option value="*/5 * * * *">{{ __('Every 5 minutes') }}</option>
                                <option value="*/10 * * * *">{{ __('Every 10 minutes') }}</option>
                                <option value="*/15 * * * *">{{ __('Every 15 minutes') }}</option>
                                <option value="*/30 * * * *">{{ __('Every 30 minutes') }}</option>
                                <option value="0 * * * *">{{ __('Every hour') }}</option>
                                <option value="0 */4 * * *">{{ __('Every 4 hours') }}</option>
                                <option value="0 */12 * * *">{{ __('Every 12 hours') }}</option>
                                <option value="0 0 * * *">{{ __('Daily') }}</option>
                            </select>
                        </div>
                    @endif
                </div>

                {{-- Webhook toggle --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Webhook') }}</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Trigger this workflow via webhook URL') }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="webhookEnabled" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-amber-600"></div>
                    </label>
                </div>
            </div>

            {{-- Actions --}}
            <div class="p-6 flex items-center justify-end gap-3">
                <a href="{{ route('dashboard.workflows') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create & Open Editor') }}
                </button>
            </div>
        </div>
    </form>
</div>
