<button {{ $attributes->merge(['type' => 'submit', 'class' => 'danger-button items-center px-3 py-1 bg-stone-100 border-2 border-rose-600 rounded-full font-semibold text-xs text-rose-600 hover:text-white uppercase tracking-widest hover:bg-rose-400 focus:bg-rose-600 active:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2 transition ease-in-out duration-200 text-center drop-shadow-md mb-2 dark:bg-stone-800 dark:text-rose-300 dark:hover:text-white dark:hover:bg-rose-500 dark:focus:bg-rose-700 dark:active:bg-rose-800 dark:border-rose-500 dark:focus:ring-rose-500 dark:focus:ring-offset-gray-900']) }}>
    {{ $slot }}
</button>
