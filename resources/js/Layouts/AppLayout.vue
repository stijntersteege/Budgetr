<template>
    <Head :title="title" />

    <jet-banner />

    <div>
        <nav class="bg-green-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <Link :href="this.route('dashboard')">
                                <jet-application-mark class="block h-9 w-auto" />
                            </Link>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <jet-nav-link :href="this.route('dashboard')"
                                              :active="this.route().current('dashboard')">
                                    Dashboard
                                </jet-nav-link>

                                <jet-nav-link :href="this.route('income')"
                                              :active="this.route().current('income') || this.route().current('income.show')">
                                    Income
                                </jet-nav-link>

                                <jet-nav-link :href="this.route('expenses')"
                                              :active="this.route().current('expenses') || this.route().current('expenses.show')">
                                    Expenses
                                </jet-nav-link>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="this.$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="this.$page.props.user.profile_photo_url" :alt="this.$page.props.user.name" />
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-200 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage account
                                    </div>

                                    <jet-dropdown-link :href="this.route('profile.show')">
                                        Settings
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="this.route('api-tokens.index')" v-if="this.$page.props.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Sign out
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="bg-green-600 inline-flex items-center justify-center p-2 rounded-md text-green-200 hover:text-white hover:bg-green-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-600 focus:ring-white transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link :href="route('income')" :active="route().current('income')">
                        Income
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link :href="route('expenses')" :active="route().current('expenses')">
                        Expenses
                    </jet-responsive-nav-link>
                </div>
                <div class="pt-4 pb-3 border-t border-green-700">
                    <div class="px-5">
                            <div class="text-base font-medium text-white">{{ this.$page.props.user.name }}</div>
                            <div class="text-sm font-medium text-green-300">{{ this.$page.props.user.email }}</div>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <jet-responsive-nav-link :href="this.route('profile.show')" :active="this.route().current('profile.show')">
                            Settings
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link :href="this.route('api-tokens.index')" :active="this.route().current('api-tokens.index')" v-if="this.$page.props.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Sign out
                            </jet-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>
