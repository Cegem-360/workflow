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
                    Új: AI-alapú workflow javaslatok
                </div>

                {{-- H1 --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-900 mb-6 font-heading leading-tight">
                    Szabadítsa fel csapata idejét az ismétlődő feladatoktól
                </h1>

                {{-- Subtitle --}}
                <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    Ne végezzen manuálisan olyat, amit a rendszer is meg tud csinálni. Állítson be szabályokat, amelyek automatikusan elvégzik a rutinfeladatokat – kód nélkül.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="/admin" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white bg-violet-600 rounded-full hover:bg-violet-700 transition-colors shadow-lg hover:shadow-xl">
                        Próbálja ki 14 napig ingyen
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-violet-700 bg-white border-2 border-violet-200 rounded-full hover:bg-violet-50 transition-colors">
                        Demó kérése
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Nincs szükség programozásra
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        50+ előre elkészített sablon
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Magyar ügyfélszolgálat
                    </span>
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
                                            <span class="text-[10px] font-semibold text-violet-600 uppercase tracking-wider">Trigger</span>
                                            <div class="flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                <span class="text-[10px] text-gray-400">Aktív</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 mb-1">Új lead érkezik</p>
                                    <p class="text-xs text-gray-500">CRM modulból</p>
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
                                            <span class="text-[10px] font-semibold text-violet-600 uppercase tracking-wider">Feltétel</span>
                                            <div class="flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 bg-violet-400 rounded-full"></span>
                                                <span class="text-[10px] text-gray-400">Elágazás</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 mb-1">Forrás ellenőrzés</p>
                                    <p class="text-xs text-gray-500">Ha forrás = Weboldal</p>
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
                                                <p class="text-sm font-medium text-gray-900">E-mail küldés</p>
                                                <p class="text-[10px] text-gray-500">Üdvözlő sablon</p>
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
                                                <p class="text-sm font-medium text-gray-900">Feladat létrehozás</p>
                                                <p class="text-[10px] text-gray-500">Felelős: Értékesítő</p>
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
                                                <p class="text-sm font-medium text-gray-900">Slack értesítés</p>
                                                <p class="text-[10px] text-gray-500">#sales csatorna</p>
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
                                <span class="text-gray-700 font-medium">Workflow aktív</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-gray-500">3 akció végrehajtva</span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/90 backdrop-blur border border-gray-200 rounded-full text-sm shadow-md">
                                <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-gray-700 font-medium">Következő: Follow-up 3 nap múlva</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats below the preview --}}
                <div class="mt-8 grid grid-cols-3 gap-4 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-violet-600">500+</div>
                        <div class="text-sm text-gray-500">Aktív workflow</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-violet-600">10 000+</div>
                        <div class="text-sm text-gray-500">Automatizált feladat/hó</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-violet-600">99.9%</div>
                        <div class="text-sm text-gray-500">Rendelkezésre állás</div>
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
                    Ismeri ezeket a problémákat?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    A legtöbb ipari cég naponta órákat veszít olyan feladatokra, amelyeket a rendszer automatikusan is el tudna végezni.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-16">
                {{-- Problem 1 --}}
                <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl p-8 border border-red-100">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Manuális adatrögzítés</h3>
                    <p class="text-gray-600">
                        Ugyanazt az információt többször is be kell írni különböző helyekre. Egy új megrendelés 5 különböző rendszerben is rögzítésre kerül.
                    </p>
                </div>

                {{-- Problem 2 --}}
                <div class="bg-gradient-to-br from-amber-50 to-white rounded-2xl p-8 border border-amber-100">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Elfelejtett határidők</h3>
                    <p class="text-gray-600">
                        Senki nem emlékezett, hogy ma kellett volna küldeni az emlékeztetőt. Az ajánlatok lejárnak, a follow-up-ok elmaradnak.
                    </p>
                </div>

                {{-- Problem 3 --}}
                <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-8 border border-orange-100">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Késleltetett reakciók</h3>
                    <p class="text-gray-600">
                        Mire észrevették a problémát, már késő volt beavatkozni. A készlethiány, a késedelem mindig utólag derül ki.
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
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">A Cégem360 Automatizálás mindezt megoldja</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            Állítson be egyszer, működjön örökké. A rendszer figyel, emlékeztet és cselekszik – Ön pedig az értékteremtésre koncentrálhat.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-2 text-gray-700">
                                <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                „Ha ez történik, akkor csináld azt" logika
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                Vizuális workflow-szerkesztő
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                Integráció az összes Cégem360 modullal
                            </li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">-70%</div>
                            <div class="text-sm text-gray-600">Admin munka csökkenés</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">5×</div>
                            <div class="text-sm text-gray-600">Gyorsabb reakcióidő</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">-90%</div>
                            <div class="text-sm text-gray-600">Elfelejtett feladat</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-3xl font-bold text-violet-600 mb-1">+30%</div>
                            <div class="text-sm text-gray-600">Produktivitás</div>
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
                    Minden eszköz a hatékony automatizáláshoz
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    A Cégem360 Automatizálás modul 6 kulcsfontosságú területen segíti a munkát.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1: Trigger-based --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Trigger-alapú automatizálás</h3>
                    <p class="text-gray-600 mb-4">
                        Definiáljon „ha ez történik, akkor csináld azt" típusú szabályokat programozás nélkül.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            50+ trigger-típus
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            30+ akció típus
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Feltételes logika és elágazások
                        </li>
                    </ul>
                </div>

                {{-- Feature 2: Email automation --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">E-mail automatizálás</h3>
                    <p class="text-gray-600 mb-4">
                        Automatikus e-mailek küldése a megfelelő pillanatban, a megfelelő tartalommal.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Üdvözlő e-mail új érdeklődőknek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Follow-up szekvenciák
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Személyre szabott sablonok
                        </li>
                    </ul>
                </div>

                {{-- Feature 3: Task automation --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Feladat-automatizálás</h3>
                    <p class="text-gray-600 mb-4">
                        Feladatok automatikus létrehozása és kiosztása események alapján.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Automatikus feladat-létrehozás
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Feladat-delegálás szabályok alapján
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Eszkaláció késedelem esetén
                        </li>
                    </ul>
                </div>

                {{-- Feature 4: Notifications --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Értesítések és riasztások</h3>
                    <p class="text-gray-600 mb-4">
                        A megfelelő ember, a megfelelő időben, a megfelelő csatornán kapjon értesítést.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Slack/Teams integráció
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            E-mail riasztások
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            SMS kritikus esetekben
                        </li>
                    </ul>
                </div>

                {{-- Feature 5: Data automation --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Adat-automatizálás</h3>
                    <p class="text-gray-600 mb-4">
                        Mezők automatikus kitöltése, rekordok létrehozása, státuszok frissítése.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Mezők automatikus kitöltése
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Rekordok automatikus létrehozása
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Kalkulált mezők
                        </li>
                    </ul>
                </div>

                {{-- Feature 6: Visual builder --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Vizuális workflow-builder</h3>
                    <p class="text-gray-600 mb-4">
                        Drag-and-drop felületen építse fel a többlépcsős automatizálásokat.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Vizuális szerkesztő
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Párhuzamos és szekvenciális ágak
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Időzített várakozások
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
                    Összekapcsolva a teljes Cégem360 rendszerrel
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Az Automatizálás modul minden más Cégem360 modullal együttműködik – és külső rendszerekkel is.
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
                        <span class="text-sm font-medium text-gray-700">Értékesítés</span>
                    </div>

                    {{-- Kontrolling --}}
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-4 border border-emerald-200 w-36 text-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Kontrolling</span>
                    </div>
                </div>

                {{-- Center - Automatizálás --}}
                <div class="flex justify-center my-6">
                    <div class="bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl p-6 text-center shadow-xl">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                        <span class="text-white font-semibold">Automatizálás</span>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-4">
                    {{-- Gyártás --}}
                    <div class="bg-gradient-to-br from-indigo-50 to-white rounded-xl p-4 border border-indigo-200 w-36 text-center">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Gyártás</span>
                    </div>

                    {{-- Beszerzés --}}
                    <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl p-4 border border-amber-200 w-36 text-center">
                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Beszerzés</span>
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
                    Amit ügyfeleink elértek az automatizálással
                </h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Valós számok, valós ügyfelektől. Az átlagos megtérülés 3-6 hónap.
                </p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">-70%</div>
                    <div class="text-sm text-gray-400">Manuális adminisztráció</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">5×</div>
                    <div class="text-sm text-gray-400">Gyorsabb reakcióidő</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">-90%</div>
                    <div class="text-sm text-gray-400">Elfelejtett feladatok</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">+25%</div>
                    <div class="text-sm text-gray-400">Ügyfél-elégedettség</div>
                </div>
                <div class="text-center col-span-2 lg:col-span-1">
                    <div class="text-4xl lg:text-5xl font-bold text-violet-400 mb-2">+30%</div>
                    <div class="text-sm text-gray-400">Csapat produktivitás</div>
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
                    Népszerű workflow-k, készen az indításra
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Válasszon az előre elkészített receptekből, vagy építsen egyedit.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Recipe 1: Sales --}}
                <div class="bg-gradient-to-br from-violet-50 to-white rounded-2xl p-8 border border-violet-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Értékesítési automatizálás</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-violet-600">Trigger:</span>
                        <span class="text-sm text-gray-600"> Új lead érkezik a weboldalról</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">Akciók:</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">1</span>
                                Üdvözlő e-mail küldése
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">2</span>
                                Feladat létrehozása az értékesítőnek
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">3</span>
                                Slack-értesítés a csatornára
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-violet-100 rounded-full flex items-center justify-center text-xs text-violet-600 font-medium">4</span>
                                3 nap múlva follow-up, ha nincs válasz
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
                        <h3 class="text-xl font-semibold text-gray-900">Pénzügyi automatizálás</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-emerald-600">Trigger:</span>
                        <span class="text-sm text-gray-600"> Számla esedékességi dátuma + 7 nap</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">Akciók:</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-xs text-emerald-600 font-medium">1</span>
                                Emlékeztető e-mail az ügyfélnek
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-xs text-emerald-600 font-medium">2</span>
                                Feladat létrehozása a pénzügynek
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-xs text-emerald-600 font-medium">3</span>
                                14 nap után: eszkaláció a vezetőhöz
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
                        <h3 class="text-xl font-semibold text-gray-900">Beszerzési automatizálás</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-amber-600">Trigger:</span>
                        <span class="text-sm text-gray-600"> Készlet a minimum szint alá csökken</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">Akciók:</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-xs text-amber-600 font-medium">1</span>
                                Riasztás a beszerzőnek
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-xs text-amber-600 font-medium">2</span>
                                Rendelési javaslat létrehozása
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-xs text-amber-600 font-medium">3</span>
                                Ha engedélyezve: automatikus megrendelés
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
                        <h3 class="text-xl font-semibold text-gray-900">Gyártási automatizálás</h3>
                    </div>
                    <div class="mb-4">
                        <span class="text-sm font-medium text-indigo-600">Trigger:</span>
                        <span class="text-sm text-gray-600"> Gyártási rendelés késésben van</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-700">Akciók:</p>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-xs text-indigo-600 font-medium">1</span>
                                Értesítés a termelésvezetőnek
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-xs text-indigo-600 font-medium">2</span>
                                Értesítés az érintett értékesítőnek
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-xs text-indigo-600 font-medium">3</span>
                                Státusz frissítése „Késésben"-re
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

    {{-- ==================== --}}
    {{-- 8. PRICING SECTION --}}
    {{-- ==================== --}}
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
                            <strong>Slack/Teams integráció</strong>
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

    {{-- ==================== --}}
    {{-- 9. FAQ SECTION --}}
    {{-- ==================== --}}
    <section id="gyik" class="py-16 lg:py-24 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                    Gyakran ismételt kérdések
                </h2>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 1 ? null : 1"
                    >
                        <span class="font-medium text-gray-900">Kell programozási tudás a használathoz?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            Nem, egyáltalán nem. A vizuális workflow-szerkesztőben drag-and-drop módon építheti fel az automatizálásokat. Ha mégis elakadna, 50+ előre elkészített sablonból is választhat.
                        </div>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 2 ? null : 2"
                    >
                        <span class="font-medium text-gray-900">Mennyi idő alatt állítható be egy workflow?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            Egy egyszerű automatizálás (pl. üdvözlő e-mail új leadnek) 5 perc alatt beállítható. Bonyolultabb, többlépcsős workflow-k 15-30 percet igényelhetnek.
                        </div>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 3 ? null : 3"
                    >
                        <span class="font-medium text-gray-900">Mi történik, ha elfogynak a havi műveletek?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            A workflow-k nem állnak le, de értesítést kap a limithez közeledésről. Bármikor vásárolhat extra műveleteket, vagy frissíthet magasabb csomagra.
                        </div>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 4 ? null : 4"
                    >
                        <span class="font-medium text-gray-900">Működik külső rendszerekkel is?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            Igen, a Professional és Enterprise csomagok támogatják a Slack, Microsoft Teams, Google Workspace integrációt. Enterprise szinten egyedi integrációk is elérhetők.
                        </div>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 5 ? null : 5"
                    >
                        <span class="font-medium text-gray-900">Hogyan tesztelhetem a workflow-kat élesítés előtt?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            A rendszer beépített teszt módot kínál. Próbafuttatást végezhet valós adatokkal anélkül, hogy az akciók ténylegesen végrehajtódnának (pl. e-mailek nem mennek ki).
                        </div>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 6 ? null : 6"
                    >
                        <span class="font-medium text-gray-900">Biztonságosak az automatizálások?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 6 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 6" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            Igen. Minden workflow jogosultság-alapú, tehát csak olyan adatokhoz és akciókhoz fér hozzá, amelyekhez a létrehozó felhasználónak joga van. Az audit log minden műveletet rögzít.
                        </div>
                    </div>
                </div>

                {{-- FAQ 7 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 7 ? null : 7"
                    >
                        <span class="font-medium text-gray-900">Használható más Cégem360 modulok nélkül?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 7 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 7" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            Az Automatizálás modul önállóan is használható, de a legnagyobb értéket más modulokkal (CRM, Értékesítés, Gyártás) kombinálva nyújtja.
                        </div>
                    </div>
                </div>

                {{-- FAQ 8 --}}
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between"
                        @click="openFaq = openFaq === 8 ? null : 8"
                    >
                        <span class="font-medium text-gray-900">Milyen támogatást kapok a bevezetéshez?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 8 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === 8" x-collapse>
                        <div class="px-6 pb-4 text-gray-600">
                            Minden csomag tartalmaz e-mail támogatást és tudásbázis hozzáférést. Professional és Enterprise csomagoknál személyes onboarding és workflow-tervezési konzultáció is jár.
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
                Készen áll automatizálni a rutinfeladatokat?
            </h2>
            <p class="text-lg text-violet-100 mb-8">
                Kezdje el 14 napos ingyenes próbaidőszakkal. Nincs szükség bankkártyára, bármikor lemondható.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="/admin" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-violet-600 bg-white rounded-full hover:bg-violet-50 transition-colors shadow-lg">
                    Ingyenes próba indítása
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="#" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white border-2 border-white/30 rounded-full hover:bg-white/10 transition-colors">
                    Demó kérése
                </a>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-violet-100">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Nincs szükség programozásra
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    50+ kész sablon
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Magyar ügyfélszolgálat
                </span>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-layouts.footer />
</x-layouts.app>
