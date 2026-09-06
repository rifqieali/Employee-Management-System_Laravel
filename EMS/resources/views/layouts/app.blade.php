<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EMS') /// EMPLOYEE MANAGEMENT SYSTEM</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --paper: #F4F4F0;
            --paper-dim: #EAE8E3;
            --ink: #111111;
            --red: #E61919;
            --line: #D8D5CC;
            --hover: #ECEAE3;
        }
        * { border-radius: 0 !important; }
        html { background: var(--paper); }
        body {
            background: var(--paper);
            color: var(--ink);
            font-family: 'Archivo', system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        /* faint mechanical grain over the whole document */
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 60;
            opacity: .05;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2'/%3E%3C/filter%3E%3Crect width='120' height='120' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
        }
        .font-macro {
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -0.04em;
            line-height: 0.9;
        }
        .font-micro {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .rule-thick { border-top: 3px solid var(--ink); }
        .rule-red { border-top: 3px solid var(--red); }

        /* ---- button system: primary / secondary / danger, 90-degree corners ---- */
        .btn {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 12px;
            font-weight: 600;
            padding: 0.65rem 1.4rem;
            border: 2px solid var(--ink);
            display: inline-block;
            line-height: 1;
            cursor: pointer;
            transition: background .12s ease, color .12s ease;
            white-space: nowrap;
        }
        .btn-primary { background: var(--ink); color: var(--paper); }
        .btn-primary:hover { background: #000; color: #fff; }
        .btn-secondary { background: transparent; color: var(--ink); }
        .btn-secondary:hover { background: var(--ink); color: var(--paper); }
        .btn-danger { background: var(--red); border-color: var(--red); color: #fff; }
        .btn-danger:hover { background: #b31212; border-color: #b31212; }
        .btn-sm { padding: 0.4rem 0.7rem; font-size: 11px; border-width: 1px; }
        .btn-outline-sm {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 11px;
            font-weight: 600;
            padding: 0.4rem 0.7rem;
            border: 1px solid var(--ink);
            background: transparent;
            color: var(--ink);
            display: inline-block;
            line-height: 1;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-outline-sm:hover { background: var(--ink); color: var(--paper); }
        .btn-danger-sm {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 11px;
            font-weight: 600;
            padding: 0.4rem 0.7rem;
            border: 1px solid var(--red);
            background: transparent;
            color: var(--red);
            display: inline-block;
            line-height: 1;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-danger-sm:hover { background: var(--red); color: #fff; }

        /* ---- form system ---- */
        .fld-label {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 11px;
            font-weight: 600;
            display: block;
            margin-bottom: 0.4rem;
        }
        .fld-input {
            display: block;
            width: 100%;
            background: #fff;
            border: 1px solid var(--ink);
            padding: 0.65rem 0.8rem;
            font-size: 0.9rem;
            color: var(--ink);
            outline: none;
        }
        .fld-input::placeholder { color: #8a877f; }
        .fld-input:focus { border-color: var(--ink); box-shadow: 3px 3px 0 var(--ink); }
        select.fld-input { appearance: auto; }
        .fld-error {
            border: 1px solid var(--red);
            border-left: 4px solid var(--red);
            background: #fff;
            color: var(--red);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.04em;
            padding: 0.5rem 0.7rem;
            margin-top: 0.5rem;
        }

        /* ---- data table ---- */
        .tbl-head th {
            font-family: 'IBM Plex Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 11px;
            font-weight: 600;
            border-bottom: 2px solid var(--ink);
            background: var(--paper-dim);
        }
        .tbl-row { border-bottom: 1px solid var(--line); }
        .tbl-row:hover td { background: var(--hover); }

        /* pagination: keep Laravel Tailwind links but force square industrial look */
        nav[role="navigation"] * { border-radius: 0 !important; box-shadow: none !important; }
    </style>
</head>
<body>

{{-- /// TOP UTILITY STRIP --}}
<div class="border-b-2 border-black" style="border-color: var(--ink);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between py-1.5 font-micro text-[10px] sm:text-[11px]">
        <span>EMS&reg; /// HR-ADMIN UNIT</span>
        <span class="hidden sm:inline">REV 2.6 /// D-01</span>
        <span>{{ strtoupper(now()->format('Y.m.d')) }}</span>
    </div>
</div>

{{-- /// MASTHEAD + NAV : blueprint grid, gap-1px determinism --}}
<header class="border-b-2 border-black" style="border-color: var(--ink); background: var(--ink); color: var(--paper);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
        <div class="md:col-span-8">
            <p class="font-micro text-[11px] mb-2" style="color: var(--paper); opacity: .65;">[ PERSONNEL RECORDS SYSTEM ]</p>
            <h1 class="font-macro" style="font-size: clamp(2.2rem, 5.5vw, 4.2rem);">@yield('masthead', 'EMS')</h1>
        </div>
        <nav class="md:col-span-4 flex md:justify-end gap-0 font-micro text-[12px] font-semibold" aria-label="Primary">
            <a href="{{ route('employee.index') }}"
               class="px-4 py-2.5 border-2 {{ request()->routeIs('employee.*') ? '' : 'opacity-70 hover:opacity-100' }}"
               style="{{ request()->routeIs('employee.*') ? 'background: var(--red); border-color: var(--red); color: #fff;' : 'border-color: var(--paper); color: var(--paper);' }}">[ Employees ]</a>
            <a href="{{ route('department.index') }}"
               class="px-4 py-2.5 border-2 border-l-0 {{ request()->routeIs('department.*') ? '' : 'opacity-70 hover:opacity-100' }}"
               style="{{ request()->routeIs('department.*') ? 'background: var(--red); border-color: var(--red); color: #fff; margin-left: -2px;' : 'border-color: var(--paper); color: var(--paper);' }}">[ Departments ]</a>
        </nav>
    </div>
    <div class="rule-red"></div>
</header>

{{-- /// PAGE META STRIP --}}
<div class="border-b" style="border-color: var(--ink);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-2 flex items-center justify-between font-micro text-[11px]">
        <span>+ @yield('doc-id', 'DOC / 000')</span>
        <span class="hidden md:inline">@yield('doc-meta', '/// SCAN ///')</span>
        <span>+</span>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    @include('partials.alerts')
    @yield('content')
</main>

<footer class="mt-10 border-t-2" style="border-color: var(--ink);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between font-micro text-[10px] sm:text-[11px]">
        <span>EMS&reg; &copy; {{ date('Y') }} /// INTERNAL USE</span>
        <span class="hidden sm:inline">+ + +</span>
        <span>END OF RECORD ///</span>
    </div>
</footer>

</body>
</html>
