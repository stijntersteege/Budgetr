<template>
    <app-layout title="Dashboard">
        <template #header>
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Dashboard
            </h1>
        </template>

        <div v-if="!(this.$page.props.monthlyIncome !== 0 && this.$page.props.monthlyExpenses !== 0)"
             class="max-w-xl mx-auto text-center">
            <h2 class="text-2xl font-bold sm:text-3xl">
                Create your budget
            </h2>

            <p class="mx-auto mt-4 text-gray-500">
                Start by adding your income and expenses to get an overview of your budget.
            </p>

            <Link v-if="this.$page.props.monthlyIncome === 0"
                :href="this.route('income')"
                class="flex items-center justify-between px-5 py-3 mt-8 text-green-600 border border-green-600 rounded-lg hover:bg-green-600 group"
            >
                <span class="text-lg font-medium group-hover:text-white">
                  Add income
                </span>

                            <span class="flex-shrink-0 p-2 ml-4 bg-white border border-green-600 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                  </svg>
                </span>
            </Link>

            <span v-if="this.$page.props.monthlyIncome !== 0"
                  class="flex items-center justify-between px-5 py-3 mt-8 border border-green-600 rounded-lg bg-green-600">
                <span class="text-lg font-medium text-white">
                  Income added
                </span>

                <span class="flex-shrink-0 p-2 ml-4 bg-white border border-green-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </span>

            <Link v-if="this.$page.props.monthlyExpenses === 0"
                  :href="this.route('expenses')"
                  class="flex items-center justify-between px-5 py-3 mt-8 text-green-600 border border-green-600 rounded-lg hover:bg-green-600 group"
            >
                <span class="text-lg font-medium group-hover:text-white">
                  Add expenses
                </span>

                <span class="flex-shrink-0 p-2 ml-4 bg-white border border-green-600 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                  </svg>
                </span>
            </Link>

            <span v-if="this.$page.props.monthlyExpenses !== 0"
                  class="flex items-center justify-between px-5 py-3 mt-8 border border-green-600 rounded-lg bg-green-600">
                <span class="text-lg font-medium text-white">
                  Expenses added
                </span>

                <span class="flex-shrink-0 p-2 ml-4 bg-white border border-green-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </span>
        </div>

        <div v-if="this.$page.props.monthlyIncome !== 0 && this.$page.props.monthlyExpenses !== 0">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Your budget
            </h3>
            <dl class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900">
                        Net Margin
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold"
                             v-bind:class="[this.$page.props.monthlyIncome - this.$page.props.monthlyExpenses >= 0 ? 'text-green-600' : 'text-red-600']">
                            €{{ (this.$page.props.monthlyIncome -
                            this.$page.props.monthlyExpenses).toLocaleString(undefined, { minimumFractionDigits: 2 }) }}
                            <span class="ml-2 text-sm font-medium text-gray-500">
            / monthly
          </span>
                        </div>

                        <div
                            class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium md:mt-2 lg:mt-0"
                            v-bind:class="[this.$page.props.monthlyIncome - this.$page.props.monthlyExpenses >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800']">
                            <svg class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true"
                                 v-if="this.$page.props.monthlyIncome - this.$page.props.monthlyExpenses >= 0">
                                <path fill-rule="evenodd"
                                      d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg v-else
                                 class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-red-500"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">
            Net Margin
          </span>
                            {{ Math.round((this.$page.props.monthlyIncome - this.$page.props.monthlyExpenses) /
                            this.$page.props.monthlyExpenses * 100) }}%
                        </div>
                    </dd>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900">
                        Income Spent
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold"
                             v-bind:class="[this.$page.props.monthlyIncome - this.$page.props.monthlyExpenses >= 0 ? 'text-green-600' : 'text-red-600']">
                            {{ Math.round(this.$page.props.monthlyExpenses / this.$page.props.monthlyIncome * 100) }}%
                        </div>
                    </dd>
                </div>

                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900">
                        5-Year Net Margin
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold"
                             v-bind:class="[this.$page.props.monthlyIncome - this.$page.props.monthlyExpenses >= 0 ? 'text-green-600' : 'text-red-600']">
                            €{{ ((this.$page.props.annualIncome - this.$page.props.annualExpenses) *
                            5).toLocaleString(undefined, { minimumFractionDigits: 2 }) }}
                        </div>
                    </dd>
                </div>
            </dl>

            <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Monthly income
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            €{{ this.$page.props.monthlyIncome.toLocaleString(undefined, {
                                            minimumFractionDigits: 2 }) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <Link :href="this.route('income')" class="font-medium text-green-700 hover:text-green-900">
                                View income
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Annual income
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            €{{ this.$page.props.annualIncome.toLocaleString(undefined, {
                                            minimumFractionDigits: 2 }) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <Link :href="this.route('income')" class="font-medium text-green-700 hover:text-green-900">
                                View income
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Monthly expenses
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            €{{ this.$page.props.monthlyExpenses.toLocaleString(undefined, {
                                            minimumFractionDigits: 2 }) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <Link :href="this.route('expenses')"
                                  class="font-medium text-green-700 hover:text-green-900">
                                View expenses
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Annual expenses
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            €{{ this.$page.props.annualExpenses.toLocaleString(undefined, {
                                            minimumFractionDigits: 2 }) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <Link :href="this.route('expenses')"
                                  class="font-medium text-green-700 hover:text-green-900">
                                View expenses
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'
import {Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        Link,
    },
})
</script>
