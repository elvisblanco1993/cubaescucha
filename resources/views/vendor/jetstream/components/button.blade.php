<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:border-indigo-600 focus:shadow-outline-indigo disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
