<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|jetbrains-mono:400,500&display=swap" rel="stylesheet"/>

<!-- Tailwind CSS & Alpine.js via CDN -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>

<style type="text/tailwindcss">
    @theme {
        --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
        --font-mono: 'JetBrains Mono', ui-monospace, monospace;
        --color-ink: #070a1f;
        --color-surface: #0f1430;
        --color-raised: #161c3d;
        --color-line: #232a52;
        --color-fg: #e6e9f5;
        --color-muted: #8b93b8;
        --color-accent: #22d3ee;
        --color-accent-dim: #0e7490;
    }

    @layer base {
        html { color-scheme: dark; }
        body { background-color: var(--color-ink); color: var(--color-fg); }
        ::selection { background: var(--color-accent); color: var(--color-ink); }

        header h2 { font-size: 1.5rem; font-weight: 600; letter-spacing: -0.02em; }

        main a:not([class]) { color: var(--color-accent); text-decoration: none; }
        main a:not([class]):hover { text-decoration: underline; text-underline-offset: 4px; }

        main table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        main th {
            text-align: left; padding: 0.75rem 1rem; font-size: 0.75rem; font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-muted);
            border-bottom: 1px solid var(--color-line);
        }
        main td { padding: 0.875rem 1rem; border-bottom: 1px solid var(--color-line); font-variant-numeric: tabular-nums; }
        main tbody tr:hover { background-color: var(--color-surface); }

        main label { display: block; margin-bottom: 0.25rem; font-size: 0.875rem; color: var(--color-muted); }
        main input:not([type=checkbox]):not([type=radio]), main select {
            width: 100%; max-width: 28rem; margin-bottom: 0.25rem; padding: 0.5rem 0.75rem;
            background-color: var(--color-surface); color: var(--color-fg);
            border: 1px solid var(--color-line); border-radius: 0.5rem;
        }
        main input:focus, main select:focus {
            outline: none; border-color: var(--color-accent);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--color-accent) 25%, transparent);
        }
        main form > div { margin-bottom: 1.25rem; }

        main button {
            padding: 0.375rem 0.875rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;
            background-color: var(--color-raised); color: var(--color-fg);
            border: 1px solid var(--color-line); border-radius: 0.5rem;
            transition: border-color 150ms, color 150ms;
        }
        main button:hover { border-color: var(--color-accent); color: var(--color-accent); }
        main button[type=submit] { background-color: var(--color-accent); color: var(--color-ink); border-color: var(--color-accent); }
        main button[type=submit]:hover { color: var(--color-ink); filter: brightness(1.1); }
        main form:has(input[name=_method][value=DELETE]) button[type=submit] { background-color: var(--color-raised); color: var(--color-muted); border-color: var(--color-line); }
        main form:has(input[name=_method][value=DELETE]) button[type=submit]:hover { color: #f87171; border-color: #f87171; filter: none; }
        main td form { display: inline-block; margin: 0 0.75rem 0 0; }
    }
</style>
