<button {{ $attributes->merge(['type' => 'submit', 'class' => 'block bg-sky-600 hover:bg-sky-700 text-center text-white font-bold w-full p-3 rounded-lg mt-4']) }}>
    {{ $slot }}
</button>
