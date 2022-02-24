<template>
    <Head title="Simple Budgeting App"/>

    <div class="bg-white pb-8 sm:pb-12 lg:pb-12">
        <div class="pt-8 overflow-hidden sm:pt-12 lg:relative lg:py-48">
            <div
                class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-7xl lg:grid lg:grid-cols-2 lg:gap-24">
                <div>
                    <div>
                        <svg class="h-11 w-11" viewBox="0 0 24 24" fill="none" stroke="green"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="mt-20">
                        <div>
                            <Link :href="this.route('register')" class="inline-flex space-x-4">
              <span
                  class="rounded bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-600 tracking-wide uppercase">
                Budgetr
              </span>
                                <span class="inline-flex items-center text-sm font-medium text-green-600 space-x-1">
                <span>Just shipped version 1.0</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                  <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"/>
                </svg>
              </span>
                            </Link>
                        </div>
                        <div class="mt-6 sm:max-w-xl">
                            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                                Income and expense tracking made simple
                            </h1>
                            <p class="mt-6 text-xl text-gray-500">
                                Get your finances in order by listing your income and expenses. Find out how simple it is.
                            </p>
                        </div>
                        <div class="mt-4">
                            <Link :href="this.route('register')"
                                  class="text-center block w-full rounded-md border border-transparent px-5 py-3 bg-green-600 text-base font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:px-10">
                                Create your budget
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:mx-auto sm:max-w-3xl sm:px-6">
                <div class="py-12 sm:relative sm:mt-12 sm:py-16 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                    <div class="hidden sm:block">
                        <div
                            class="absolute inset-y-0 left-1/2 w-screen bg-gray-50 rounded-l-3xl lg:left-80 lg:right-0 lg:w-full"></div>
                        <svg class="absolute top-8 right-1/2 -mr-3 lg:m-0 lg:left-0" width="404" height="392"
                             fill="none" viewBox="0 0 404 392">
                            <defs>
                                <pattern id="837c3e70-6c3a-44e6-8854-cc48c737b659" x="0" y="0" width="20" height="20"
                                         patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                                </pattern>
                            </defs>
                            <rect width="404" height="392" fill="url(#837c3e70-6c3a-44e6-8854-cc48c737b659)"/>
                        </svg>
                    </div>
                    <div class="relative pl-4 -mr-40 sm:mx-auto sm:max-w-3xl sm:px-0 lg:max-w-none lg:h-full lg:pl-12">
                        <img
                            class="w-full rounded-md shadow-xl ring-1 ring-black ring-opacity-5 lg:h-full lg:w-auto lg:max-w-none"
                            src="preview.png" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="max-w-7xl
        mx-auto
        py-12
        px-4
        sm:px-6
        md:flex md:items-center md:justify-between
        lg:px-8">
                <div class="flex justify-center space-x-6 md:order-2"><a href="https://github.com/stijntersteege"
                                                                         class="text-gray-400 hover:text-gray-400"><span
                    class="sr-only">GitHub</span>
                    <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6">
                        <path fill-rule="evenodd"
                              d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a></div>
                <div class="mt-8 md:mt-0 md:order-1"><p class="text-center text-base text-gray-400">
                    © 2022 Stijn ter Steege
                </p></div>
            </div>
        </footer>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import {Head, Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        Link,
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    }
})
</script>
