<template>
      <div class="flex justify-center py-6 min-h-[600px]">
        <div class="max-w-sm w-full border border-slate-200 p-4 text-gray-700 hover:text-red-800 hover:shadow-lg transition-all ease-in-out duration-500 cursor-pointer">
            <img class="w-full h-64 object-cover" src="https://picsum.photos/400/800">
            <div class="mt-4 space-y-4">
                <p class="text-lg text-center leading-5">รายวิชา {{ subject.code }} {{ subject.name_th }}</p>
                <div class="text-sm text-center text-gray-700 font-normal space-y-2">
                    <div v-for="professor in subject.professors" :key="professor.id">
                        <p>อาจารย์ {{ professor.prefix }} {{ professor.first_name }} {{ professor.last_name }}</p>
                        <p>{{ professor.department.name }}</p>
                    </div>
                    <p>เผยแพร่วันที่ {{ subject.published_at }}</p>
                    <p>จำนวนผู้เยี่ยมชม: </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"TeachingMaterialCard",
    props: {
        subject: {
            type: Object,
            required: true
        }
    },
    mounted() {                 //เอาไว้เช็คเพจทำการโหลดให้ทำอะไร สมมุติหน้านี้โหลดให้เแสดงข้อมูล subjects
      

        console.log('-----------');
        console.log(this.subject);
        console.log('-----------');
    }

}
</script>



<style scoped>

</style>

