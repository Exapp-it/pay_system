<script>
import {Link} from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        links: Array,
    }
}
</script>

<template>
    <div v-if="links.length > 3"
         class="flex justify-end items-center m-2"
    >
        <nav class="flex justify-center gap-1 text-xs font-medium">
            <Link v-for="(link, key) in links" :key="key"
                  :href="link.url"
                  :disabled="link.url === null"
                  :class="{'text-sky-500 bg-green-100 font-bold': link.active, 'bg-red-300': link.url === null}"
                  v-html="link.label"
                  class="block py-2 px-4 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
            />

        </nav>
    </div>
</template>
