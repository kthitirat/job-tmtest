<template>
    <Layout>
        <div class="flex justify-end">
            <Link :href="route('dashboard.subjects.create')" class="uppercase btn btn-primary">New Subject</Link>
        </div>
        
        <div class="mt-4">
            <label class="form-control w-full max-w-xs relative">
                <input ref="searchInputRef" v-model="search" type="text" placeholder="ค้นหา..." class="input input-bordered w-full max-w-xs pr-8 " />
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

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">ภาพหน้าปก</th>
                    <th class="px-6 py-3">รหัสวิชา</th>
                    <th class="px-6 py-3">ชื่อวิชา</th>                  
                    <th class="px-6 py-3">วันที่เผยแพร่</th>                   
                    <th class="px-6 py-3">อาจารย์ผู้สอน</th>                   
                    <th class="px-6 py-3">Action</th>                   
                </tr>
                </thead>
                <tbody v-if="subjectData!=null">
                <tr v-for="(subject,index) in subjectData" :key="index"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <!-- <th>{{ index + 1 }}</th> -->
                    <th class="text-center">{{ subject.raw_id }}</th>
                    <!-- <td class="px-6 py-4">
                        <Link :href="route('dashboard.announcements.show',announcement.id)" class="underline">
                            {{ subject.title }}
                        </Link>
                    </td> -->
                    <td class="px-6 py-4">
                        <div v-if="subject.image.data.length > 0" class="w-20 h-25">
                            <img :src="subject.image.data[0].url" class="object-cover h-full w-50">
                        </div>
                    </td>
                    
                    <td class="px-6 py-4">{{ subject.code }}</td>
                    <td>
                        <Link :href="route('dashboard.subjects.edit',subject.raw_id)" class="underline">
                            <p> {{ subject.name_th }}</p>
                            <p> {{ subject.name_en }}</p>
                        </Link>
                    </td>
                    <td class="px-6 py-4">{{ subject.display_published_at }}</td>
                    <td>
                        <div>
                            <p v-for="(professor) in subject.professors">
                                {{ professor.prefix }} {{ professor.first_name }} {{ professor.last_name }}
                            </p>
                        </div>                        
                    </td>
                    <td>
                        <button @click="handleDeleteSubject(subject)" type="button" class="btn btn-error text-white btn-sm font-light">
                            Delete
                        </button>
                    </td>   
                </tr>
                </tbody>
            </table>
        </div>
        <div v-if="pagination != null" id="pagination" class="mt-4 flex justify-between items-center">
            <div>แสดง {{ pagination.from }} ถึง {{ pagination.to }} จาก {{ pagination.total }} แถว</div>
            <div class="join">
                <button v-for="(pag,index) in pagination.links" :key="index"
                        :class="pag.active ?'btn-active':''"
                        class="join-item btn btn-md" @click="selectPage(pag)">
                    {{ pag.label }}
                </button>
            </div>
        </div>
    </Layout>
</template>

<script>

import Layout from "@/Pages/Dashboard/Layout/Layout.vue";
import {Link} from "@inertiajs/vue3";
import axios from 'axios';
import {Inertia} from "@inertiajs/inertia";
import {nextTick} from "vue";
import {router} from "@inertiajs/vue3";

export default {
    name:"SubjectIndex",
    components: {
        Link,
        Layout,
    },
    props: {
        subjects:{
            type: Object,
            required: true
        }
    },

    data() {
        return{
            subjectData: null,
            pagination: null,
            search: new URLSearchParams(window.location.search).get('search') ?? null,
            debouce:null            
        }
    },
    mounted() {
        this.subjectData = this.subjects.data;
        this.pagination = this.subjects.meta.pagination;
        this.$refs.searchInputRef.focus();

    },

    methods: {
        handleDeleteSubject(subject) {          //การลบ Delete
            this.$swal.fire({
                title: "คุณต้องการที่จะลบวิชา" + subject.name_th + '?',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: 'ลบ'
            }).then((result) => {
                if (result.isDenied) {
                    Inertia.delete(this.route('dashboard.subjects.destroy', subject.id));
                    nextTick(()=> {
                        window.location.reload();
                    })
                }
            });
        },
        selectPage(pag) {
            Inertia.get(pag.url);
        },
        async submitSearch() {
            const url = this.route('dashboard.subjects.index', {
                search: this.search
            })
            await router.visit(url, {
                only: ['subjects'],
            })
        }
    },
    watch:{  
        search(){
            clearTimeout(this.debouce)
            this.debouce = setTimeout(() => {
                this.submitSearch();
            }, 500 );
            // console.log('-----------');
            // console.log(this.search);
            // console.log('-----------');
        }
    }
}
</script>

<style scoped>

</style>

