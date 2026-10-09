<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-accent border border-transparent rounded-lg font-semibold text-xs text-ink uppercase tracking-widest hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-ink transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
