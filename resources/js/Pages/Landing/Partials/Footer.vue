<script setup lang="ts"></script>

<template>
    <footer
        class="bottom-0 left-0 z-20 w-full border-t border-primary bg-[#061222] p-4 shadow-sm dark:border-gray-600 dark:bg-primary md:flex md:items-center md:justify-between md:p-6"
    >
        <span class="text-sm text-white dark:text-[#061222] sm:text-center">
            © 2025
            <a href="#" class="text-primary hover:underline dark:text-white">Motorcytech™</a>. "La
            seguridad que tu moto necesita"
        </span>
        <ul
            class="mt-3 flex flex-wrap items-center text-sm font-medium text-white dark:text-white sm:mt-0"
        >
            <li>
                <a :href="route('privacy')" class="me-4 text-primary hover:underline dark:text-white md:me-6"
                    >Políticas de privacidad</a
                >
            </li>
            <li>
                <a :href="route('terms')" class="me-4 text-primary hover:underline dark:text-white md:me-6"
                    >Términos y condiciones</a
                >
            </li>
        </ul>
    </footer>
</template>
