<button {{ $attributes->merge(['type' => 'button', 'class' => 'secondary-button items-center px-3 py-1 bg-stone-100 border-2 border-slate-600 rounded-full font-semibold text-xs text-slate-600 hover:text-white uppercase tracking-widest hover:bg-slate-400 transition ease-in-out duration-200 text-center drop-shadow-md mb-2 dark:bg-gray-800 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-500 dark:border-slate-500 dark:focus:ring-slate-500 dark:focus:ring-offset-gray-900']) }}>
    {{ $slot }}
</button>
