<template>
      <div 
         @click="visitSubject"
        class="flex justify-center py-6 min-h-[550px]">
        <div class="max-w-sm w-full border border-slate-200 p-4 text-gray-700 hover:text-red-800 hover:shadow-lg transition-all ease-in-out duration-500 cursor-pointer relative">
            <img class="w-full h-64 object-cover" src="https://picsum.photos/400/800">
            <div class="mt-4 space-y-4">
                <p class="text-lg text-center leading-5">รายวิชา {{ subject.code }} {{ subject.name_th }}</p>
                <div class="text-sm text-center text-gray-700 font-normal space-y-2"> 
                    <div>
                        <div v-for="professor in subject.professors" :key="professor.id">
                        <p>อาจารย์ {{ professor.prefix }} {{ professor.first_name }} {{ professor.last_name }}</p>
                        <p>{{ professor.department.name }}</p>
                    </div>
                    <p>เผยแพร่วันที่ {{ subject.published_at }}</p>
                    <!-- <p>จำนวนผู้เยี่ยมชม: {{ subject.view }}</p> -->
                    </div>                 
                                                        
                    <div class="mt-4 flex gap-2 items-center justify-end text-blue-600 absolute bottom-4 right-4 text-xs">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        {{ subject.view }}
                    </div>
                                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {router} from "@inertiajs/vue3";
export default {
    name:"TeachingMaterialCard",
    components:{
      
    },
    props: {
        subject: {
            type: Object,
            required: true
        }
    },
    mounted() {                 //เอาไว้เช็คเพจทำการโหลดให้ทำอะไร สมมุติหน้านี้โหลดให้เแสดงข้อมูล subjects
      
        // console.log('-----------');
        // console.log(this.subject);
        // console.log('-----------');
    },
    methods:{
        visitSubject() {
            router.visit(this.route('subjects.show', this.subject.id));
        }
    }

}
</script>



<style scoped>

    .relative {
        padding-bottom: 40px; /* เพิ่มระยะห่างด้านล่างเพื่อให้มีพื้นที่สำหรับไอคอน */
    }

    .absolute {
        position: absolute;
        bottom: 16px;
        right: 16px;
    }

    /* ปรับปรุงสำหรับหน้าจอขนาดเล็ก */
    @media (max-width: 768px) {
        .absolute {
            position: static; /* ยกเลิก absolute positioning */
            display: flex;
            justify-content: center; /* จัดกึ่งกลาง */
            margin-top: 16px; /* เพิ่มระยะห่างด้านบน */
        }
    }

</style>

