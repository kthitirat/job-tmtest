<template>
    <Layout>
        <div class="w-full">
            <div class="flex justify-center">
                <h1 class="text-4xl font-bold text-gray-700">เอกสารประกอบการสอน </h1>
                <h1 class="text-4xl font-bold text-blue-600">(PowerPoint)</h1>
            </div>
            <div class="grid grid-cols-4 gap-8 px-16 mt-10">
                <div class="w-full border border-slate-200 p-4">
                    <img class="w-full h-80 object-cover" src="https://picsum.photos/400/800">
                    <!-- <img class="w-full h-[500px] object-cover" src="https://picsum.photos/400/800"> -->
                     <div class="mt-2">
                        <p class="text-lg text-gray-700 text-center leading-5">รายวิชา 1161207 การอ่านคิดพัฒนาชีวิต</p>
                        <div class="text-sm text-center mt-4">
                            <p>อาจารย์รุ่งทิวา สุภานันท์</p>
                            <p>คณะครุศาสตร์</p>
                            <p>เผยแพร่วันที่ 10 มิถุนายน 2567</p>
                            <p>จำนวนผู้เยี่ยมชม: </p>
                        </div>
                        
                     </div>
                </div>
                         
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Pages/Layout/Layout.vue";
//import TeachingMaterialCard from "@/Pages/Components/TeachingMaterialCard.vue";
import axios from 'axios';
import {Link} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Layout},
    props: {


    },


};
</script>


