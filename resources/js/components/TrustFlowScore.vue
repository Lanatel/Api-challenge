<template>
    <div>
        <b-table striped hover :items="items"></b-table>
    </div>
</template>

<script>
import { BButton, BTable } from 'bootstrap-vue'
export default {
    components: {
        'b-table': BTable
    },
    data() {
        return {
            items: []
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
