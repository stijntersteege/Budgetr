<template>
    <app-layout title="Income">
        <template #header>
            <div class="flex justify-between">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">
                    Income
                </h1>
                <jet-primary-button @click="openModal">
                    Add income
                </jet-primary-button>

                <jet-dialog-modal :show="showIncomeModal" @close="closeModal">
                    <template #title v-if="this.$page.props.incomeDetail === undefined">
                        Add income
                    </template>

                    <template #title v-else>
                        Modify income
                    </template>

                    <template #content>
                        <div class="mt-4">
                            <jet-input type="text" class="mt-1 block w-full"
                                       placeholder="Description"
                                       ref="description"
                                       v-model="form.description"/>

                            <jet-input-error :message="form.errors.description" class="mt-2"/>

                            <jet-input type="number" class="mt-1 block w-1/4"
                                       placeholder="Amount"
                                       ref="amount"
                                       min="0"
                                       v-model="form.amount"
                                       @keyup.enter="addIncome"/>

                            <jet-input-error :message="form.errors.amount" class="mt-2"/>

                            <label for="period"
                                   class="mt-1 block text-sm font-medium text-gray-700">Period</label>
                            <select id="period" name="period"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md"
                                    v-model="form.period">
                                <option value="monthly">Monthly</option>
                                <option value="annually">Annually</option>
                            </select>

                            <jet-input-error :message="form.errors.period" class="mt-2"/>
                        </div>
                    </template>

                    <template #footer v-if="this.$page.props.incomeDetail === undefined">
                        <jet-secondary-button @click="closeModal">
                            Cancel
                        </jet-secondary-button>

                        <jet-primary-button class="ml-2" @click="addIncome" :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                            Add
                        </jet-primary-button>
                    </template>

                    <template #footer v-else>
                        <jet-secondary-button @click="closeModal">
                            Cancel
                        </jet-secondary-button>

                        <jet-danger-button class="mx-2" @click="deleteIncome">
                            Delete
                        </jet-danger-button>

                        <jet-primary-button @click="updateIncome" :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                            Save
                        </jet-primary-button>
                    </template>
                </jet-dialog-modal>
            </div>
        </template>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white" v-for="income in this.$page.props.income" :key="income.id">
                                    <td class="flex px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate">
                                        <Link :href="this.route('income.show', income)"
                                              class="flex space-x-2 text-gray-500 hover:text-gray-700">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                                        clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                            <span>
                                                {{ income.description }}
                                            </span>
                                        </Link>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="text-gray-900 font-medium">€{{ income.amount.toLocaleString(undefined, { minimumFractionDigits: 2 }) }}</span>
                                        {{ income.period }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
import JetActionSection from '@/Jetstream/ActionSection.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetPrimaryButton from '@/Jetstream/PrimaryButton.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import {Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    props: ['income'],

    components: {
        AppLayout,
        JetActionSection,
        JetDangerButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetPrimaryButton,
        JetSecondaryButton,
        Link,
    },

    data() {
        return {
            showIncomeModal: false,

            form: this.$inertia.form({
                description: '',
                amount: '',
                period: 'monthly'
            })
        }
    },

    methods: {
        openModal() {
            this.showIncomeModal = true;

            setTimeout(() => this.$refs.description.focus(), 250);
        },

        addIncome() {
            this.form.post(this.route('income.store'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.description.focus(),
                onFinish: () => this.form.reset(),
            });
        },

        deleteIncome() {
            this.form.delete(this.route('income.destroy', this.$page.props.incomeDetail.id), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.description.focus(),
                onFinish: () => this.form.reset(),
            });
        },

        updateIncome() {
            this.form.put(this.route('income.update', this.$page.props.incomeDetail.id), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.description.focus(),
                onFinish: () => this.form.reset(),
            });
        },

        closeModal() {
            this.showIncomeModal = false;

            this.form.reset();

            this.$inertia.visit(this.route('income'));
        },
    },

    created() {
        this.showIncomeModal = this.$page.props.showIncomeModal;

        if (this.$page.props.incomeDetail !== undefined) {
            this.form = this.$inertia.form({
                description: this.$page.props.incomeDetail.description,
                amount: this.$page.props.incomeDetail.amount,
                period: this.$page.props.incomeDetail.period
            })
        }
    }
})
</script>
