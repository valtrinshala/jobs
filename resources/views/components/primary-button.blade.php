<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-tertiary-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-tertiary-600 focus:bg-gray-700 dark:focus:bg-tertiary-700 active:bg-gray-900 dark:active:bg-tertiary-600 focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
