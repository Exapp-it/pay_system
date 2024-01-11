<script>
import Admin from "../../Layouts/Admin.vue"
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head},
    layout: Admin,
    props: {
        title: String,
    }
}
</script>

<template>
    <Head :title="title" />
    <h1>Index Page</h1>
</template>

