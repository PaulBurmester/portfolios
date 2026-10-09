<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-raised border border-line rounded-lg font-semibold text-xs text-fg uppercase tracking-widest hover:border-accent focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-ink disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
