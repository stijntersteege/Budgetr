<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium'
                    : 'text-white hover:bg-green-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium'
            }
        }
    })
</script>
