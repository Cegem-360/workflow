<x-layouts.app>
    {{-- Navbar --}}
    <x-layouts.navbar />

    {{-- ==================== --}}
    {{-- 1. HERO SECTION --}}
    {{-- ==================== --}}
    <section class="bg-gradient-to-b from-violet-50 to-white pt-24 pb-16 lg:pt-32 lg:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-violet-100 text-violet-700 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    {{ __('New: AI-powered workflow suggestions') }}
                </div>

                {{-- H1 --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-900 mb-6 font-heading leading-tight">
                    {{ __('Free your team\'s time from repetitive tasks') }}
                </h1>

                {{-- Subtitle --}}
                <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    {{ __('Don\'t do manually what the system can do. Set up rules that automatically handle routine tasks – no code needed.') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center mb-8">
                    <a href="https://cegem360.eu/register" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white bg-violet-600 rounded-full hover:bg-violet-700 transition-colors shadow-lg hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="https://cegem360.eu/kapcsolat" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-violet-700 bg-white border-2 border-violet-200 rounded-full hover:bg-violet-50 transition-colors">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="/login" class="text-sm text-violet-600 hover:text-violet-700 font-medium">{{ __('Log in to the app') }} →</a>
                </div>
            </div>

            {{-- Hero Image/Workflow Preview --}}
            <div class="mt-16 relative">
                {{-- Background decorations --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-violet-200 rounded-full opacity-20 blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-60 h-60 bg-purple-200 rounded-full opacity-20 blur-3xl"></div>
                </div>

                <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden max-w-5xl mx-auto">
                    {{-- Header bar --}}
                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 flex items-center gap-3">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="flex-1 flex items-center justify-center">
                            <div class="bg-white border border-gray-200 rounded-lg px-4 py-1.5 flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                workflow.cegem360.hu/editor
                            </div>
                        </div>
                    </div>

                    {{-- Workflow canvas --}}
                    <div class="relative bg-gradient-to-br from-gray-50 via-violet-50/20 to-gray-50 p-8 min-h-[400px]">
                        {{-- Grid pattern --}}
                        <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle, #6b7280 1px, transparent 1px); background-size: 24px 24px;"></div>

                        {{-- SVG Connections - softer violet tones --}}
                        <svg class="absolute inset-0 w-full h-full pointer-events-none hidden lg:block" style="z-index: 1;">
                            {{-- Connection 1: Trigger to Condition --}}
                            <path d="M 200 120 Q 280 120, 320 120" fill="none" stroke="#c4b5fd" stroke-width="2" stroke-dasharray="6,4" />
                            {{-- Connection 2: Condition to Actions --}}
                            <path d="M 500 120 Q 560 120, 600 80" fill="none" stroke="#c4b5fd" stroke-width="2" stroke-dasharray="6,4" />
                            <path d="M 500 120 Q 560 120, 600 160" fill="none" stroke="#c4b5fd" stroke-width="2" stroke-dasharray="6,4" />
                            <path d="M 500 120 Q 560 120, 600 240" fill="none" stroke="#c4b5fd" stroke-width="2" stroke-dasharray="6,4" />
                        </svg>

                        <div class="relative flex flex-col lg:flex-row items-start justify-center gap-6 lg:gap-12" style="z-index: 2;">
                            {{-- Trigger Node --}}
                            <div class="animate-float group">
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-5 w-56 hover:shadow-xl hover:border-gray-300 transition-all duration-300">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-semibold text-violet-600 uppercase tracking-wider">{{ __('Trigger') }}</span>
                                            <div class="flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                <span class="text-[10px] text-gray-400">{{ __('Active') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 mb-1">{{ __('New lead arrives') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('From CRM module') }}</p>
                                </div>
                            </div>

                            {{-- Arrow (mobile) --}}
                            <div class="lg:hidden flex justify-center">
                                <svg class="w-6 h-6 text-gray-300 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>

                            {{-- Condition Node --}}
                            <div class="animate-float-delayed group">
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-5 w-56 hover:shadow-xl hover:border-gray-300 transition-all duration-300">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-semibold text-violet-600 uppercase tracking-wider">{{ __('Condition') }}</span>
                                            <div class="flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 bg-violet-400 rounded-full"></span>
                                                <span class="text-[10px] text-gray-400">{{ __('Branch') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 mb-1">{{ __('Source check') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('If source = Website') }}</p>
                                </div>
                            </div>

                            {{-- Arrow (mobile) --}}
                            <div class="lg:hidden flex justify-center">
                                <svg class="w-6 h-6 text-gray-300 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>

                            {{-- Action Nodes --}}
                            <div class="flex flex-col gap-4 animate-float-delayed-2">
                                {{-- Email action --}}
                                <div class="group">
                                    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-4 w-48 hover:shadow-lg hover:border-gray-300 transition-all duration-300">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ __('Send email') }}</p>
                                                <p class="text-[10px] text-gray-500">{{ __('Welcome template') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Task action --}}
                                <div class="group">
                                    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-4 w-48 hover:shadow-lg hover:border-gray-300 transition-all duration-300">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ __('Create task') }}</p>
                                                <p class="text-[10px] text-gray-500">{{ __('Assigned: Sales rep') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Notification action --}}
                                <div class="group">
                                    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-4 w-48 hover:shadow-lg hover:border-gray-300 transition-all duration-300">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ __('Slack notification') }}</p>
                                                <p class="text-[10px] text-gray-500">{{ __('#sales channel') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating status cards --}}
                        <div class="absolute bottom-4 left-4 right-4 flex flex-wrap justify-center gap-3">
                            <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/90 backdrop-blur border border-gray-200 rounded-full text-sm shadow-md">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                <span class="text-gray-700 font-medium">{{ __('Workflow active') }}</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-gray-500">{{ __('3 actions executed') }}</span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/90 backdrop-blur border border-gray-200 rounded-full text-sm shadow-md">
                                <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-gray-700 font-medium">{{ __('Next: Follow-up in 3 days') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats below the preview --}}
                <div class="mt-8 grid grid-cols-3 gap-4 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-violet-600">500+</div>
                        <div class="text-sm text-gray-500">{{ __('Active workflows') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-violet-600">10 000+</div>
                        <div class="text-sm text-gray-500">{{ __('Automated tasks/month') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-violet-600">99.9%</div>
                        <div class="text-sm text-gray-500">{{ __('Uptime') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 2. PROBLEM-SOLUTION SECTION --}}
    {{-- ==================== --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    {{ __('Do you recognize these problems?') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('Most industrial companies lose hours daily on tasks that the system could handle automatically.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-16">
                {{-- Problem 1 --}}
                <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl p-8 border border-red-100">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Manual data entry') }}</h3>
                    <p class="text-gray-600">
                        {{ __('The same information must be entered multiple times in different places. A new order is recorded in 5 different systems.') }}
                    </p>
                </div>

                {{-- Problem 2 --}}
                <div class="bg-gradient-to-br from-amber-50 to-white rounded-2xl p-8 border border-amber-100">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Forgotten deadlines') }}</h3>
                    <p class="text-gray-600">
                        {{ __('Nobody remembered that the reminder should have been sent today. Quotes expire, follow-ups are missed.') }}
                    </p>
                </div>

                {{-- Problem 3 --}}
                <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-8 border border-orange-100">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Delayed reactions') }}</h3>
                    <p class="text-gray-600">
                        {{ __('By the time the problem was noticed, it was too late to intervene. Stockouts and delays are always discovered after the fact.') }}
                    </p>
                </div>
            </div>

            {{-- Solution --}}
            <div class="bg-violet-50 rounded-2xl p-8 lg:p-12 border border-violet-100 max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1">
                        <div class="w-16 h-16 bg-violet-100 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('Cégem360 Automation solves all of this') }}</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            {{ __('Set up once, run forever. The system watches, reminds and acts – so you can focus on creating value.') }}
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-2 text-gray-700">
                                <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ __('\"If this happens, then do that\" logic') }}
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ __('Visual workflow editor') }}
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ __('Integration with all Cégem360 modules') }}
                            </li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">-70%</div>
                            <div class="text-sm text-gray-600">{{ __('Admin work reduction') }}</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">5×</div>
                            <div class="text-sm text-gray-600">{{ __('Faster response time') }}</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">-90%</div>
                            <div class="text-sm text-gray-600">{{ __('Forgotten tasks') }}</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">+30%</div>
                            <div class="text-sm text-gray-600">{{ __('Productivity') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 3. FEATURES SECTION --}}
    {{-- ==================== --}}
    <section id="funkciok" class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    {{ __('All tools for effective automation') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('The Cégem360 Automation module helps in 6 key areas.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1: Trigger-based --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Trigger-based automation') }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ __('Define \"if this happens, then do that\" type rules without programming.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('50+ trigger types') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('30+ action types') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Conditional logic and branching') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 2: Email automation --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Email automation') }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ __('Send automatic emails at the right moment, with the right content.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Welcome email for new leads') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Follow-up sequences') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Personalized templates') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 3: Task automation --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Task automation') }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ __('Automatic task creation and assignment based on events.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Automatic task creation') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Task delegation based on rules') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Escalation in case of delay') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 4: Notifications --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Notifications and alerts') }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ __('The right person, at the right time, on the right channel gets notified.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Slack/Teams integration') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Email alerts') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('SMS for critical cases') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 5: Data automation --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Data automation') }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ __('Automatic field filling, record creation, status updates.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Automatic field filling') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Automatic record creation') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Calculated fields') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 6: Visual builder --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Visual workflow builder') }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ __('Build multi-step automations on a drag-and-drop interface.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Visual editor') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Parallel and sequential branches') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Timed waits') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 4. INTEGRATIONS SECTION --}}
    {{-- ==================== --}}
    <section id="integraciok" class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    {{ __('Connected to the entire Cégem360 system') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('The Automation module works with all other Cégem360 modules – and external systems too.') }}
                </p>
            </div>

            {{-- Integration Hub --}}
            <div class="relative max-w-4xl mx-auto">
                <div class="flex flex-wrap justify-center items-center gap-4">
                    {{-- CRM --}}
                    <div class="bg-gradient-to-br from-sky-50 to-white rounded-xl p-4 border border-sky-200 w-36 text-center">
                        <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">CRM</span>
                    </div>

                    {{-- Értékesítés --}}
                    <div class="bg-gradient-to-br from-red-50 to-white rounded-xl p-4 border border-red-200 w-36 text-center">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ __('Sales') }}</span>
                    </div>

                    {{-- Kontrolling --}}
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-4 border border-emerald-200 w-36 text-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ __('Controlling') }}</span>
                    </div>
                </div>

                {{-- Center - Automatizálás --}}
                <div class="flex justify-center my-6">
                    <div class="bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl p-6 text-center shadow-xl">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                        <span class="text-white font-semibold">{{ __('Automation') }}</span>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-4">
                    {{-- Gyártás --}}
                    <div class="bg-gradient-to-br from-indigo-50 to-white rounded-xl p-4 border border-indigo-200 w-36 text-center">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ __('Manufacturing') }}</span>
                    </div>

                    {{-- Beszerzés --}}
                    <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl p-4 border border-amber-200 w-36 text-center">
                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ __('Procurement') }}</span>
                    </div>

                    {{-- Slack/Teams --}}
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-gray-200 w-36 text-center">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Slack/Teams</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 5. RESULTS SECTION --}}
    {{-- ==================== --}}
    <section class="py-16 lg:py-24 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-white mb-4 font-heading">
                    {{ __('What our customers achieved with automation') }}
                </h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    {{ __('Real numbers, from real customers. Average ROI is 3-6 months.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">-70%</div>
                    <div class="text-sm text-gray-400">{{ __('Manual administration') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">5×</div>
                    <div class="text-sm text-gray-400">{{ __('Faster response time') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">-90%</div>
                    <div class="text-sm text-gray-400">{{ __('Forgotten tasks') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">+25%</div>
                    <div class="text-sm text-gray-400">{{ __('Customer satisfaction') }}</div>
                </div>
                <div class="text-center col-span-2 lg:col-span-1">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">+30%</div>
                    <div class="text-sm text-gray-400">{{ __('Team productivity') }}</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 6. RECIPES SECTION --}}
    {{-- ==================== --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    {{ __('Popular workflows, ready to launch') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('Choose from pre-made recipes, or build your own.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Recipe 1: Sales --}}
                <div class="bg-gradient-to-br from-violet-50 to-white rounded-2xl p-8 border border-violet-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ __('Sales automation') }}</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-violet-600">{{ __('Trigger:') }}</span>
                        <span class="text-sm text-gray-600"> {{ __('New lead arrives from the website') }}</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">{{ __('Actions:') }}</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">1</span>
                                {{ __('Send welcome email') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">2</span>
                                {{ __('Create task for sales rep') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">3</span>
                                {{ __('Slack notification to the channel') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">4</span>
                                {{ __('Follow-up in 3 days if no response') }}
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Recipe 2: Finance --}}
                <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-8 border border-emerald-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ __('Financial automation') }}</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-emerald-600">{{ __('Trigger:') }}</span>
                        <span class="text-sm text-gray-600"> {{ __('Invoice due date + 7 days') }}</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">{{ __('Actions:') }}</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-xs text-emerald-600 font-medium">1</span>
                                {{ __('Reminder email to the customer') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-xs text-emerald-600 font-medium">2</span>
                                {{ __('Create task for finance') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-xs text-emerald-600 font-medium">3</span>
                                {{ __('After 14 days: escalation to manager') }}
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Recipe 3: Procurement --}}
                <div class="bg-gradient-to-br from-amber-50 to-white rounded-2xl p-8 border border-amber-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ __('Procurement automation') }}</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-amber-600">{{ __('Trigger:') }}</span>
                        <span class="text-sm text-gray-600"> {{ __('Stock drops below minimum level') }}</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">{{ __('Actions:') }}</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-xs text-amber-600 font-medium">1</span>
                                {{ __('Alert to the purchaser') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-xs text-amber-600 font-medium">2</span>
                                {{ __('Create order suggestion') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-xs text-amber-600 font-medium">3</span>
                                {{ __('If approved: automatic order') }}
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Recipe 4: Manufacturing --}}
                <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-8 border border-indigo-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ __('Manufacturing automation') }}</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-indigo-600">{{ __('Trigger:') }}</span>
                        <span class="text-sm text-gray-600"> {{ __('Production order is delayed') }}</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">{{ __('Actions:') }}</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-xs text-indigo-600 font-medium">1</span>
                                {{ __('Notification to production manager') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-xs text-indigo-600 font-medium">2</span>
                                {{ __('Notification to the affected sales rep') }}
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-xs text-indigo-600 font-medium">3</span>
                                {{ __('Update status to \"Delayed\"') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 7. TESTIMONIALS SECTION --}}
    {{-- ==================== --}}
    @if(false)
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    Amit ügyfeleink mondanak
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        „A rendszer automatikusan emlékeztet a határidőkre, és értesíti a kollégát, ha rá vár egy feladat. Nekem nem kell utánajárni."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-violet-100 rounded-full flex items-center justify-center text-violet-600 font-semibold">
                            VE
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Varga Eszter</div>
                            <div class="text-sm text-gray-500">Üzemeltetési igazgató, Ipari cég</div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        „Korábban minden reggel 2 órát töltöttem e-mailek küldésével és feladatok kiosztásával. Most mindezt a rendszer csinálja, én csak ellenőrzöm."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">
                            KP
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Kovács Péter</div>
                            <div class="text-sm text-gray-500">Értékesítési vezető, B2B szolgáltató</div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        „Az automatikus készletfigyelés óta egyszer sem fordult elő, hogy kifogytunk volna alapanyagból. Ez korábban havi 2-3 alkalommal megtörtént."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-semibold">
                            NM
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Nagy Márton</div>
                            <div class="text-sm text-gray-500">Ügyvezető, Gyártó cég</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ==================== --}}
    {{-- 8. PRICING SECTION --}}
    {{-- ==================== --}}
    @if(false)
    <section id="arak" class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    Egyszerű, átlátható árak
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Válassza ki a cégére szabott csomagot. Minden csomag tartalmaz 14 napos ingyenes próbaidőszakot.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                {{-- Starter --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Starter</h3>
                    <div class="mb-4">
                        <span class="text-4xl font-bold text-gray-900">7 900 Ft</span>
                        <span class="text-gray-500">/hó</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-6">Kis csapatok számára</p>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            10 aktív workflow
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            1 000 művelet/hó
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            E-mail értesítések
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            10 kész sablon
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            E-mail támogatás
                        </li>
                    </ul>

                    <a href="/admin" class="block w-full py-3 text-center text-sm font-medium text-violet-600 border-2 border-violet-200 rounded-full hover:bg-violet-50 transition-colors">
                        Ingyenes próba
                    </a>
                </div>

                {{-- Professional --}}
                <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-violet-500 relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                        <span class="inline-block px-4 py-1 bg-violet-500 text-white text-xs font-semibold rounded-full">
                            Legnépszerűbb
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Professional</h3>
                    <div class="mb-4">
                        <span class="text-4xl font-bold text-gray-900">19 900 Ft</span>
                        <span class="text-gray-500">/hó</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-6">Növekvő cégek számára</p>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <strong>Korlátlan workflow</strong>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            10 000 művelet/hó
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            <strong>{{ __('Slack/Teams integration') }}</strong>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            50+ kész sablon
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Prioritásos támogatás
                        </li>
                    </ul>

                    <a href="/admin" class="block w-full py-3 text-center text-sm font-medium text-white bg-violet-600 rounded-full hover:bg-violet-700 transition-colors">
                        Ingyenes próba
                    </a>
                </div>

                {{-- Enterprise --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Enterprise</h3>
                    <div class="mb-4">
                        <span class="text-2xl font-bold text-gray-900">Egyedi</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-6">Nagyvállalatok számára</p>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Minden Professional funkció
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Korlátlan művelet
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Egyedi integrációk
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Dedikált account manager
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            SLA garancia
                        </li>
                    </ul>

                    <a href="#" class="block w-full py-3 text-center text-sm font-medium text-violet-600 border-2 border-violet-200 rounded-full hover:bg-violet-50 transition-colors">
                        Ajánlat kérése
                    </a>
                </div>
            </div>

            {{-- Trust badges --}}
            <div class="mt-12 text-center">
                <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        14 napos ingyenes próbaidőszak
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Nincs szükség bankkártyára
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Bármikor lemondható
                    </span>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ==================== --}}
    {{-- 9. FAQ SECTION --}}
    {{-- ==================== --}}
    <section id="gyik" class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    {{ __('Frequently asked questions') }}
                </h2>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 1 ? null : 1"
                    >
                        <span class="font-medium text-gray-900">{{ __('Do I need programming knowledge to use it?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('No, not at all. In the visual workflow editor, you can build automations using drag-and-drop. If you get stuck, you can also choose from 50+ pre-made templates.') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 2 ? null : 2"
                    >
                        <span class="font-medium text-gray-900">{{ __('How long does it take to set up a workflow?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('A simple automation (e.g., welcome email for new leads) can be set up in 5 minutes. More complex, multi-step workflows may take 15-30 minutes.') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 3 ? null : 3"
                    >
                        <span class="font-medium text-gray-900">{{ __('What happens if I run out of monthly operations?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('Workflows don\'t stop, but you get notified when approaching the limit. You can purchase extra operations anytime, or upgrade to a higher plan.') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 4 ? null : 4"
                    >
                        <span class="font-medium text-gray-900">{{ __('Does it work with external systems too?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('Yes, Professional and Enterprise plans support Slack, Microsoft Teams, Google Workspace integration. Custom integrations are available at Enterprise level.') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 5 ? null : 5"
                    >
                        <span class="font-medium text-gray-900">{{ __('How can I test workflows before going live?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('The system offers a built-in test mode. You can run tests with real data without actions being actually executed (e.g., emails are not sent out).') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 6 ? null : 6"
                    >
                        <span class="font-medium text-gray-900">{{ __('Are automations secure?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 6 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 6" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('Yes. Every workflow is permission-based, so it can only access data and actions that the creator has rights to. The audit log records every operation.') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 7 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 7 ? null : 7"
                    >
                        <span class="font-medium text-gray-900">{{ __('Can it be used without other Cégem360 modules?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 7 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 7" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('The Automation module can be used standalone, but it provides the most value when combined with other modules (CRM, Sales, Manufacturing).') }}
                        </div>
                    </div>
                </div>

                {{-- FAQ 8 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 8 ? null : 8"
                    >
                        <span class="font-medium text-gray-900">{{ __('What support do I get for implementation?') }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 8 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 8" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            {{ __('All plans include email support and knowledge base access. Professional and Enterprise plans also include personal onboarding and workflow design consultation.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== --}}
    {{-- 10. CTA SECTION --}}
    {{-- ==================== --}}
    <section class="py-16 lg:py-24 bg-violet-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-semibold text-white mb-4 font-heading">
                {{ __('Ready to automate routine tasks?') }}
            </h2>
            <p class="text-lg text-violet-100 mb-8">
                {{ __('Digitize and automate your company\'s workflows on a single platform.') }}
            </p>

            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center">
                <a href="https://cegem360.eu/register" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-violet-600 bg-white rounded-full hover:bg-violet-50 transition-colors shadow-lg">
                    {{ __('Get started') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="https://cegem360.eu/kapcsolat" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white border-2 border-white/30 rounded-full hover:bg-white/10 transition-colors">
                    {{ __('Request a demo') }}
                </a>
                <a href="/login" class="text-sm text-violet-100 hover:text-white font-medium">{{ __('Log in to the app') }} →</a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-layouts.footer />
</x-layouts.app>
