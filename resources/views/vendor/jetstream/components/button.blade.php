<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-bluegray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-bluegray-900 active:bg-bluegray-700 focus:outline-none focus:border-bluegray-800 focus:shadow-outline-bluegray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
