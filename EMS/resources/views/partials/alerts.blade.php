{{-- Shared success / error feedback. Square, mono, industrial. --}}
@if (session('success'))
    <div class="mb-6 border-2 border-black flex items-stretch" style="border-color: var(--ink);" role="alert">
        <div class="font-micro text-[12px] font-bold px-3 py-2.5 text-white shrink-0" style="background: var(--ink);">[ OK ]</div>
        <div class="px-4 py-2.5 text-sm font-medium self-center">{{ session('success') }}</div>
    </div>
@endif
@if (session('error'))
    <div class="mb-6 bg-white flex items-stretch" style="border: 2px solid var(--red);" role="alert">
        <div class="font-micro text-[12px] font-bold px-3 py-2.5 text-white shrink-0" style="background: var(--red);">[ ERR ]</div>
        <div class="px-4 py-2.5 text-sm font-medium self-center">{{ session('error') }}</div>
    </div>
@endif
