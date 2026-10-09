@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-surface text-fg border border-line focus:border-accent focus:ring-accent rounded-lg px-3 py-2    ']) }}>
