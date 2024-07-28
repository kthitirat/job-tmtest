<template>
    <Layout>
        <div class="w-full">
            <div class="flex justify-center">
                <h1 class="text-2xl md:text-4xl font-bold text-gray-700">เอกสารประกอบการสอน</h1>
                <h1 class="text-2xl md:text-4xl font-bold text-blue-600">(PowerPoint)</h1>
            </div>

            <div class="w-full px-4 md:px-6 lg:px10 xl:px-16 mt-4">
                <label class="form-control w-full max-w-xs relative">
                    <input ref="searchInputRef" v-model="search" type="text" placeholder="ค้นหา..." class="input input-bordered w-full max-w-xs pr-8" />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                        class="h-4 w-4 opacity-70 absolute top-1/2 right-2 transform -translate-y-1/2">
                        <path
                            fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 md:px-16">
                <div v-for="(subject,index) in subjectData" :key="subject.id">
                    <TeachingMaterialCard :subject="subject"/>  
                </div>    
            </div>
            <div v-if="pagination !== null" class="px-4 md:px-6 lg:px10 xl:px-16 mt-4 flex justify-end">
                <!-- {{ pagination.links }} -->
                <div class="join">
                    <Link v-for="(pagination,index) in pagination.links" :key="index" 
                            :class="pagination.active ?'btn-active':''" 
                            :href="pagination.url ?? '#'"                             
                            class="join-item btn">
                            {{ pagination.label }}
                    </Link>
                   
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
    components: {Layout, TeachingMaterialCard, Link},
    props: {
        subjects:{
            type:Object,
            required: true
        } 

    },
    data() {                        //data สร้างตัวแปร       
        return {
            subjectData: null,
            pagination: null,
            search: new URLSearchParams(window.location.search).get('subjects') ?? null,
            debouce: null,
        }
    },
    mounted() {                 //เอาไว้เช็คเพจทำการโหลดให้ทำอะไร สมมุติหน้านี้โหลดให้เแสดงข้อมูล subjects
        this.subjectData = this.subjects.data
        this.pagination = this.subjects.meta.pagination;
        this.$refs.searchInputRef.focus();

        // console.log('-----------');
        // console.log(this.pagination);
        // console.log('-----------');
    },
    methods: {
        async submitSearch() {
            const url = this.route('index',{
                search: this.search
            })
            await router.visit(url, {
                only: ['subjects'],
                })
        }

    },
    watch: {
        search() {
            clearTimeout(this.debouce)
            this.debouce = setTimeout(() => {
                this.submitSearch();
            }, 500);
           
        }
    },


};
</script>


