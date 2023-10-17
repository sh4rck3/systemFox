<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    target: String,
    as: String,
});

</script>

<template>
    <Link 
    v-if="as =='a'"
    :href="href" :target="target">
        <slot />
    </Link>
</template>
