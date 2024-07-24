<template>
    <Layout>
        <div class="w-full">
            <div class="flex justify-center">
                <h1 class="text-2xl md:text-4xl font-bold text-gray-700">เอกสารประกอบการสอน</h1>
                <h1 class="text-2xl md:text-4xl font-bold text-blue-600">(PowerPoint)</h1>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 md:px-16 mt-10">
                <div v-for="(subject,index) in subjectData" :key="subject.id">   
                    <TeachingMaterialCard :subject="subject"/>  
                </div>    
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Pages/Layout/Layout.vue";
import TeachingMaterialCard from "@/Pages/Components/TeachingMaterialCard.vue";
import axios from 'axios';
import {Link} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Layout, TeachingMaterialCard},
    props: {
        subjects:{
            type:Object,
            required: true
        } 

    },
    data() {                        //data สร้างตัวแปร       
        return {
            subjectData: null,
            pagination: null
        }
    },
    mounted() {                 //เอาไว้เช็คเพจทำการโหลดให้ทำอะไร สมมุติหน้านี้โหลดให้เแสดงข้อมูล subjects
        this.subjectData = this.subjects.data
        this.pagination = this.subjects.meta.pagination;

        // console.log('-----------');
        // console.log(this.pagination);
        // console.log('-----------');
    }


};
</script>


