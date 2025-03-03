<template>
    <div>
        <h1>Booking system {{ obj.count }}</h1>
        <button type="button" @click="incriment">Increase</button>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'

export default {
    name: 'Welcome',
    setup(props) {
        const obj = reactive({ count: 0 })

        const incriment = () => obj.count++;
        return {
            obj, incriment
        }
    }
};
</script>
