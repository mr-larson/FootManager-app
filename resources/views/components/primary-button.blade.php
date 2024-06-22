<button {{ $attributes->merge(['type' => 'submit', 'class' => 'primary-button items-center px-3 py-1 bg-stone-100 border-2 border-blue-600 rounded-full font-semibold text-xs text-blue-600 hover:text-white uppercase tracking-widest hover:bg-blue-400 transition ease-in-out duration-200 text-center drop-shadow-md mb-2 dark:bg-gray-800 dark:text-blue-300 dark:hover:text-white dark:hover:bg-blue-500 dark:border-blue-500']) }}>
    {{ $slot }}
</button>
