<template>
    <div>
        <button :class="classes" class="w-full text-left" v-if="as == 'button'">
            <slot></slot>
        </button>

        <Link :href="href" :class="classes" v-else>
            <slot />
        </Link>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['active', 'href', 'as'],

        computed: {
            classes() {
                return this.active
                    ? 'bg-green-700 text-white block px-3 py-2 rounded-md text-base font-medium'
                    : 'text-white hover:bg-green-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium'
            }
        }
    })
</script>
