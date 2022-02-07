<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-900 active:bg-slate-700 focus:outline-none focus:border-slate-800 focus:shadow-outline-slate disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
