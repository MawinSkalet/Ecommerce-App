@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-white/30 dark:border-white/20 bg-white/50 dark:bg-white/10 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 focus:border-emerald-400 dark:focus:border-emerald-400 focus:ring-emerald-400 dark:focus:ring-emerald-400 rounded-md shadow-sm backdrop-blur-sm']) }}>
