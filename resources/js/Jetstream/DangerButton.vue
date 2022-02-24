<template>
    <button :type="type"
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
        <slot></slot>
    </button>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        type: {
            type: String,
            default: 'button',
        },
    }
})
</script>
