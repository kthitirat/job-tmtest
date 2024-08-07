<template>
    <Layout>
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
                        <button type="button" class="btn btn-error text-white btn-sm font-light">
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
import {Inertia} from "@inertiajs/inertia";
import {nextTick} from "vue";

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
            pagination: null
        }
    },
    mounted() {
        this.subjectData = this.subjects.data;
        this.pagination = this.subjects.meta.pagination;

    },

    methods: {
        selectPage(pag) {
            Inertia.get(pag.url);
        },
    },
}
</script>

<style scoped>

</style>

