<script setup>
import { ref, watch, defineProps } from 'vue'
import { useRoute } from 'vue-router'
import OdaiCard from './OdaiCard.vue'
import { OK } from '../util'
import { useStoreAuth } from '../stores/auth'

const { mode } = defineProps({
    mode: {
        type: String,
        default: 'recent',
    }
})

const route = useRoute()
const auth = useStoreAuth()

const odais = ref([])

const fetchOdais = async () => {
    auth.setApiStatus(null)
    try {
        const res = await axios.get('/api/getOdais')
        if (res.status === OK) {
            odais.value = res.data.data
            auth.setApiStatus(true)
        }
    } catch (error) {
        auth.setApiStatus(false)
        setCode(error.response.status)
    }
}

watch(route, () => {
    fetchOdais()
},
{ immediate: true }
)

</script>

<template>
    <div id="content" :class="(mode === 'recent') ? 'rounded-tr rounded-br rounded-bl' : 'rounded'" class="bg-white p-4">
        <OdaiCard v-for="odai in odais" :key="odai.id" :item="odai"/>
    </div>
</template>