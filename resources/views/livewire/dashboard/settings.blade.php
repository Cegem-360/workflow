<div>
    {{-- Page header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Settings') }}</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Configure your workflow automation settings') }}</p>
    </div>

    {{-- Settings form --}}
    <form wire:submit="save" class="max-w-2xl space-y-6">
        {{-- Default Workflow Settings --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Default Workflow Settings') }}</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Configure default settings for new workflows') }}</p>
            </div>

            <div class="p-6 space-y-6">
                {{-- Default Schedule --}}
                <div>
                    <label for="defaultScheduleCron" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Default Schedule') }}
                    </label>
                    <select
                        id="defaultScheduleCron"
                        wire:model="defaultScheduleCron"
                        class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 transition"
                    >
                        <option value="">{{ __('Select default schedule...') }}</option>
                        <option value="* * * * *">{{ __('Every minute') }}</option>
                        <option value="*/5 * * * *">{{ __('Every 5 minutes') }}</option>
                        <option value="*/15 * * * *">{{ __('Every 15 minutes') }}</option>
                        <option value="*/30 * * * *">{{ __('Every 30 minutes') }}</option>
                        <option value="0 * * * *">{{ __('Every hour') }}</option>
                        <option value="0 */4 * * *">{{ __('Every 4 hours') }}</option>
                        <option value="0 0 * * *">{{ __('Daily') }}</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('This schedule will be pre-selected for new workflows') }}</p>
                </div>

                {{-- Auto-activate workflows --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Auto-activate new workflows') }}</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Automatically activate workflows when created') }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="autoActivateWorkflows" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-violet-600"></div>
                    </label>
                </div>

                {{-- Execution Timeout --}}
                <div>
                    <label for="executionTimeout" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Execution Timeout') }}
                    </label>
                    <div class="flex items-center gap-2">
                        <input
                            type="number"
                            id="executionTimeout"
                            wire:model="executionTimeout"
                            min="30"
                            max="3600"
                            class="w-32 px-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 transition"
                        >
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('seconds') }}</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Maximum execution time for workflow runs (30-3600 seconds)') }}</p>
                    @error('executionTimeout')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Notifications --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Notifications') }}</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Configure notification preferences') }}</p>
            </div>

            <div class="p-6 space-y-6">
                {{-- Enable notifications --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Enable notifications') }}</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Receive notifications about workflow runs and errors') }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="notificationsEnabled" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-violet-600"></div>
                    </label>
                </div>

                {{-- Notification Email --}}
                @if($notificationsEnabled)
                    <div>
                        <label for="notificationEmail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Notification Email') }}
                        </label>
                        <input
                            type="email"
                            id="notificationEmail"
                            wire:model="notificationEmail"
                            placeholder="example@company.com"
                            class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 border-0 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-violet-500 transition"
                        >
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Email address for workflow notifications') }}</p>
                        @error('notificationEmail')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>
        </div>

        {{-- Save button --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Save Settings') }}
            </button>
        </div>
    </form>
</div>
