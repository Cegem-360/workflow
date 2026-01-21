# Landing Page Sections

## Standard Section Order

1. **Hero** - Main headline, subtitle, CTAs, visual
2. **Problem/Solution** - Pain points and how module solves them
3. **Features** - 6 feature cards in 3-column grid
4. **Integrations** - Hub showing connected services
5. **Results/Metrics** - Statistics and outcomes
6. **Use Cases/Recipes** - 4 practical workflow examples
7. **Testimonials** - 3 customer quotes
8. **Pricing** - 3 tiers (Starter, Professional, Enterprise)
9. **FAQ** - 6-8 accordion items
10. **CTA** - Final call to action

---

## 1. Hero Section

```blade
<section class="bg-gradient-to-b from-[MODULE_COLOR]-50 to-white pt-24 pb-16 lg:pt-32 lg:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-[MODULE_COLOR]-100 text-[MODULE_COLOR]-700 rounded-full text-sm font-medium mb-6">
                <svg class="w-4 h-4"><!-- icon --></svg>
                Új: Feature announcement
            </div>

            {{-- H1 --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-900 mb-6 font-heading leading-tight">
                Main headline in Hungarian
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                Compelling subtitle explaining the value proposition.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="/admin" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white bg-[MODULE_COLOR]-600 rounded-full hover:bg-[MODULE_COLOR]-700 transition-colors shadow-lg">
                    Próbálja ki 14 napig ingyen
                    <svg class="w-5 h-5"><!-- arrow --></svg>
                </a>
                <a href="#" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-[MODULE_COLOR]-700 bg-white border-2 border-[MODULE_COLOR]-200 rounded-full hover:bg-[MODULE_COLOR]-50">
                    Demó kérése
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-gray-500">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[MODULE_COLOR]-500"><!-- check --></svg>
                    Trust point 1
                </span>
                <!-- more trust points -->
            </div>
        </div>

        {{-- Hero Visual --}}
        <div class="mt-16 relative">
            <!-- Module-specific visualization -->
        </div>
    </div>
</section>
```

---

## 2. Problem/Solution Section

```blade
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                Ismeri ezeket a problémákat?
            </h2>
            <p class="text-lg text-gray-600">
                Brief intro to the problems this module solves.
            </p>
        </div>

        {{-- Problem Cards (3 columns) --}}
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl p-8 border border-red-100">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600"><!-- icon --></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Problem Title</h3>
                <p class="text-gray-600">Problem description...</p>
            </div>
            <!-- 2 more problem cards with amber-* and orange-* colors -->
        </div>

        {{-- Solution Box --}}
        <div class="bg-[MODULE_COLOR]-50 rounded-2xl p-8 lg:p-12 border border-[MODULE_COLOR]-100 max-w-4xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <div class="flex-1">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4 font-heading">
                        A Cégem360 Module mindezt megoldja
                    </h3>
                    <p class="text-gray-700 mb-4">Solution description...</p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-[MODULE_COLOR]-600"><!-- check --></svg>
                            Benefit 1
                        </li>
                        <!-- more benefits -->
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="bg-white rounded-xl p-4">
                        <div class="text-2xl font-bold text-[MODULE_COLOR]-600">-70%</div>
                        <div class="text-sm text-gray-600">Metric label</div>
                    </div>
                    <!-- more metric boxes -->
                </div>
            </div>
        </div>
    </div>
</section>
```

---

## 3. Features Section (6 cards)

```blade
<section id="funkciok" class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                Minden eszköz a hatékony [module function]-hoz
            </h2>
            <p class="text-lg text-gray-600">Description...</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Feature Card Template --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-[MODULE_COLOR]-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-[MODULE_COLOR]-600"><!-- feature icon --></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Feature Title</h3>
                <p class="text-gray-600 mb-4">Feature description paragraph.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[MODULE_COLOR]-500"><!-- check --></svg>
                        Bullet point 1
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[MODULE_COLOR]-500"><!-- check --></svg>
                        Bullet point 2
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[MODULE_COLOR]-500"><!-- check --></svg>
                        Bullet point 3
                    </li>
                </ul>
            </div>
            {{-- Repeat for 5 more features --}}
        </div>
    </div>
</section>
```

---

## 4. Pricing Section (3 tiers)

```blade
<section id="arak" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                Egyszerű, átlátható árak
            </h2>
            <p class="text-lg text-gray-600">
                Válassza ki a cégére szabott csomagot.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            {{-- Starter Tier --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Starter</h3>
                <div class="mb-4">
                    <span class="text-4xl font-bold text-gray-900">7 900 Ft</span>
                    <span class="text-gray-500">/hó</span>
                </div>
                <p class="text-gray-600 text-sm mb-6">Kis csapatok számára</p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-[MODULE_COLOR]-500"><!-- check --></svg>
                        Feature 1
                    </li>
                    <!-- more features -->
                </ul>
                <a href="/admin" class="block w-full py-3 text-center text-sm font-medium text-[MODULE_COLOR]-600 border-2 border-[MODULE_COLOR]-200 rounded-full hover:bg-[MODULE_COLOR]-50">
                    Kipróbálom
                </a>
            </div>

            {{-- Professional Tier (Featured) --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-[MODULE_COLOR]-500 relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                    <span class="bg-[MODULE_COLOR]-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        Legnépszerűbb
                    </span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Professional</h3>
                <div class="mb-4">
                    <span class="text-4xl font-bold text-gray-900">19 900 Ft</span>
                    <span class="text-gray-500">/hó</span>
                </div>
                <p class="text-gray-600 text-sm mb-6">Növekvő vállalkozásoknak</p>
                <ul class="space-y-3 mb-8">
                    <!-- features with checks -->
                </ul>
                <a href="/admin" class="block w-full py-3 text-center text-sm font-medium text-white bg-[MODULE_COLOR]-600 rounded-full hover:bg-[MODULE_COLOR]-700">
                    Kezdés most
                </a>
            </div>

            {{-- Enterprise Tier --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Enterprise</h3>
                <div class="mb-4">
                    <span class="text-4xl font-bold text-gray-900">Egyedi</span>
                </div>
                <p class="text-gray-600 text-sm mb-6">Nagyvállalatok igényeire</p>
                <ul class="space-y-3 mb-8">
                    <!-- features -->
                </ul>
                <a href="#" class="block w-full py-3 text-center text-sm font-medium text-gray-700 border-2 border-gray-200 rounded-full hover:bg-gray-50">
                    Ajánlat kérése
                </a>
            </div>
        </div>
    </div>
</section>
```

---

## 5. FAQ Section (Accordion)

```blade
<section id="gyik" class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
                Gyakran ismételt kérdések
            </h2>
        </div>

        <div class="space-y-4">
            {{-- FAQ Item --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-6 py-4 text-left flex items-center justify-between">
                    <span class="font-medium text-gray-900">Question text?</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse>
                    <div class="px-6 pb-4 text-gray-600">
                        Answer text with details...
                    </div>
                </div>
            </div>
            {{-- Repeat for each FAQ item --}}
        </div>
    </div>
</section>
```

---

## 6. Final CTA Section

```blade
<section class="py-16 lg:py-24 bg-gradient-to-r from-[MODULE_COLOR]-600 to-[MODULE_COLOR_SECONDARY]-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-semibold text-white mb-4 font-heading">
            Készen áll az automatizálásra?
        </h2>
        <p class="text-lg text-white/80 mb-8 max-w-2xl mx-auto">
            Compelling final message...
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/admin" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-[MODULE_COLOR]-600 bg-white rounded-full hover:bg-gray-100">
                Ingyenes próba indítása
                <svg><!-- arrow --></svg>
            </a>
            <a href="#" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold text-white border-2 border-white/30 rounded-full hover:bg-white/10">
                Beszéljen szakértőnkkel
            </a>
        </div>
    </div>
</section>
```
