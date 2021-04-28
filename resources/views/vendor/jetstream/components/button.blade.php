<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blueGray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blueGray-900 active:bg-blueGray-700 focus:outline-none focus:border-blueGray-800 focus:shadow-outline-blueGray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
