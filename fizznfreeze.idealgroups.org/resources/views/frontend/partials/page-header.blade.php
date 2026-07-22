{{--
    Reusable page header partial.
    Variables:
      $backHref   – URL for the back link
      $backLabel  – Text for the back link          (default: 'Back')
      $icon       – Emoji / character in the icon pill
      $title      – Main heading text
      $subtitle   – Smaller subtitle below the heading
      $showLive   – (bool) show the pulsing live indicator  (default: false)
--}}
<div class="relative overflow-hidden pt-10 pb-12 px-4"
     style="background: linear-gradient(135deg, #681F32 0%, #a83255 60%, #c94a6e 100%);">

    {{-- Decorative blurred orbs --}}
    <div class="absolute -top-6 -right-6 w-36 h-36 rounded-full opacity-20"
         style="background:#fff; filter:blur(28px);"></div>
    <div class="absolute bottom-4 -left-8 w-28 h-28 rounded-full opacity-15"
         style="background:#fff; filter:blur(22px);"></div>

    <div class="max-w-md mx-auto relative z-10">

        {{-- Back link --}}
        <a href="{{ $backHref }}"
           class="inline-flex items-center text-white/80 hover:text-white text-sm mb-5 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ $backLabel ?? 'Back' }}
        </a>

        {{-- Title row --}}
        <div class="flex items-center gap-3 mb-1">
            <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-xl flex-shrink-0">
                {{ $icon ?? '🍽️' }}
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">{{ $title }}</h1>
        </div>

        {{-- Subtitle / live indicator --}}
        @if(!empty($showLive))
        <div class="flex items-center gap-2 mt-2 ml-1">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-400"></span>
            </span>
            <p class="text-white/75 text-sm">{{ $subtitle ?? 'Live updates' }}</p>
        </div>
        @else
        <p class="text-white/70 text-sm mt-2 ml-1">{{ $subtitle ?? '' }}</p>
        @endif
    </div>

    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
             class="w-full h-8 block">
            <path d="M0,20 C360,40 1080,0 1440,20 L1440,40 L0,40 Z" fill="{{ $waveColor ?? '#f8f9ff' }}"/>
        </svg>
    </div>
</div>
