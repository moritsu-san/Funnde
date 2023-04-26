<script setup>
import OdaiList from '../../components/OdaiList.vue'
</script>
<template>
    <div class="content-menu">
        <ul class="flex">
            <li class="bg-white px-2 mr-3 text-gray-600 rounded-t font-bold">
                <RouterLink to="/answer/recent" class="text-bold" target="_self">新着</RouterLink>
            </li>
            <li class="px-2 mr-3 text-gray-600 rounded-t font-bold">
                <RouterLink to="/answer/popular" target="_self">人気</RouterLink>
            </li>
        </ul>
    </div>
    <OdaiList mode="recent"/>
    <!-- <div class="col-md-8">
        {{ $threads->links() }}
    </div>  -->
</template>
