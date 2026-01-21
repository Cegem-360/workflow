<x-layouts.dashboard :title="__('Connected Apps')">
    <div>
        {{-- Page header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Connected Apps') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Manage your connected applications and integrations') }}</p>
        </div>

        {{-- Coming soon placeholder --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ __('Coming Soon') }}</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('This page is under development.') }}</p>
        </div>
    </div>
</x-layouts.dashboard>
