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
    }
</style>
