<template>
         <form @submit.prevent="submit">
            <div class="w-full md:grid-cols-3 gap-2 p-4">
                    <button class="w-60 h-72 border border-dashed flex items-center justify-center"
                            type="button" @click="$refs.imageInputRef.click()">
                        <div v-if="displaySubjectImage === null">   <!--v-if="displaySubjectImage === null" ให้แสดงปุ่ม + -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <img v-if="displaySubjectImage!=null" :src="displaySubjectImage" class="w-full h-72 object-cover" >
                    </button>  
                    <input @change="handleSubjectImage" ref="imageInputRef" type="file" class="hidden" accept="image/*">  
                </div> 
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4 p-4">                
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">รหัสวิชา</span>                    
                        </div>
                        <input v-model="form.code" type="text" placeholder="รหัสวิชา" class="input input-bordered w-full" />              
                    </label>
                </div>   
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">ชื่อวิชา(ภาษาไทย)</span>                    
                        </div>
                        <input v-model="form.name_th"  type="text" placeholder="ชื่อวิชา(ภาษาไทย)" class="input input-bordered w-full" />              
                    </label>
                </div> 
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">ชื่อวิชา(ภาษาอังกฤษ)</span>                    
                        </div>
                        <input v-model="form.name_en"  type="text" placeholder="ชื่อวิชา(ภาษาอังกฤษ)" class="input input-bordered w-full" />              
                    </label>
                </div>  
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">หน่วยกิต</span>                    
                        </div>
                        <input v-model="form.unit"  type="text" placeholder="เช่น 3(3-3-0-6)" class="input input-bordered w-full" />              
                    </label>
                </div>
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">วันที่เผยแพร่</span>                    
                        </div>
                        <input v-model="form.published_at"  type="date" placeholder="" class="input input-bordered w-full" />              
                    </label>
                </div>
            </div>       
       
            <div class="w-full md:grid-cols-3 gap-2 p-4">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">คำอธิบายรายวิชา</span>                    
                    </div>
                    <textarea v-model="form.description"  placeholder="คำอธิบายรายวิชา" class="textarea textarea-bordered textarea-md w-full" rows="5"></textarea>
                </label>
            </div>  
            
            <div class="w-full md:grid-cols-3 gap-2 p-4">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">เลือกอาจารย์</span>                        
                    </div>
                    <select v-model="currentSelectingProfessor" class="select select-bordered"
                            @change="handSelectProfessor">
                        <option value="">เลือกอาจารย์</option>
                        <option v-for="professor in professors" :key="professor.id" :value="professor">
                            <p>
                            {{ professor.prefix }} {{ professor.first_name }} {{ professor.last_name }}
                            </p>                            
                        </option>
                    </select>                 
                </label>
                <div v-if="form.professors.length > 0" class="w-full flex flex-col md:flex-row gap-4 mt-4">
                    <div v-for="(professor, professorIndex) in form.professors" :key="professor.id"
                        class="w-40 border flex flex-col pb-2 relative">
                        <img class="object-cover w-full h-40" :src="professor.image.data[0].url">
                        <div class="text-xs text-center leading-4 mt-2">                         
                            <p>{{ professor.prefix  }} {{ professor.first_name  }} {{ professor.last_name  }}</p>
                            <p>{{ professor.department.name }}</p>
                        </div>   
                        <button @click="handleRemoveProfessor(professorIndex)" type="button" class="absolute top-1 right-2 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>                  
                    </div>
                </div>
            </div>

            <div class="w-full md:grid-cols-3 gap-2 p-4">
                <span class="label-text">เอกสารการสอน</span>                        
            </div>
            <div class="w-full p-4 flex flex-row md:grid-cols-3 gap-2"> 
                <div v-if="form.documents.length > 0" class="flex gap-2" >
                    <div v-for="(doc,index) in form.documents" :key="index" 
                        class="w-40 border flex flex-col pb-2 relative">
                        <div class="h-24 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>

                        </div>    
                        <div class="text-xs text-center leading-4 mt-2">
                            <p>{{ doc.name }}</p>
                        </div> 
                        <button @click="handleRemoveDucument(index)" type="button" class="absolute top-1 right-2 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>   
                    </div>
                </div>            
               
                <button class="w-40 h-40 border border-dashed flex flex-col pb-2 justify-center items-center" 
                        type="button" @click="$refs.documentInputRef.click()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
                <input @change="handleSubjectDocument" ref="documentInputRef" type="file" class="hidden" accept="application/pdf">
            </div>
            <div class="col-span-3 w-full flex justify-end mt-4">
                <button class="uppercase btn btn-primary">Submit</button>
            </div>
     
        </form>
</template>

<script>
import {router} from "@inertiajs/vue3";
export default {
    name: 'SubjectForm',
    props:{
        professors: {
            type: Array,
            required: true
        },
        subject:{
            type: Object,
             default: {}
        },
        mode:{
            type: String,
            default: "create"
        }
    },
   
    data() {
        return{
            form:{
                image: null,
                code: null,
                name_th: null,
                name_en: null,
                unit: null,
                published_at: null,
                description: null,
                professors: [],
                documents: []
            },
            displaySubjectImage: null,
            currentSelectingProfessor: ""

        }
    },
    mounted() {
        if (this.mode === 'create') {           //อันนี้โหมด create
            return;
        }
        if (this.subject.image.data.length > 0) {        //อันนี้โหมด edit
            this.displaySubjectImage = this.subject.image.data[0].url;
        }
        this.form.code = this.subject.code;
        this.form.name_th = this.subject.name_th;
        this.form.name_en = this.subject.name_en;
        this.form.unit = this.subject.unit;
        this.form.description = this.subject.description;
        this.form.published_at = this.subject.published_at;          
        this.form.description = this.subject.description;

        this.subject.professors.forEach(professor => {          //ของอาจารย์
            this.form.professors.push(professor)
        })

        this.subject.documents.data.forEach(doc => {
            this.form.documents.push(doc)
        })
     
    },
    methods:{
        handleRemoveDucument(index){
            this.form.documents.splice(index, 1);
        },
        handleSubjectDocument(event){
            const file = event.target.files[0];
            this.form.documents.push(file);    
        },
        handleRemoveProfessor(index){           
            this.form.professors.splice(index, 1);
        },
        handSelectProfessor(){
            this.form.professors.push(this.currentSelectingProfessor);
            this.currentSelectingProfessor = "";
        },
        handleSubjectImage(event) {
            const image = event.target.files[0];
            this.form.image = image;
            const blob = new Blob([image], {type: image.type});
            const blobUrl = URL.createObjectURL(blob);
            this.displaySubjectImage = blobUrl;
        },
        submit(){
            let url = this.route('dashboard.subjects.store');
            if (this.mode === 'edit') {
                url = this.route('dashboard.subjects.update', this.subject.raw_id);
            }
            router.post( url, {
                _method: 'patch',
                image: this.form.image,
                code: this.form.code,
                name_th: this.form.name_th,
                name_en: this.form.name_en,
                unit: this.form.unit,
                published_at: this.form.published_at,
                description: this.form.description,
                professors: this.form.professors,
                documents: this.form.documents,
            })

            // console.log('--------');
            // console.log('ok');
            // console.log('--------');
        },
        watch: {
            form: {
            handler: function () {           
            },
            deep: true
            }
        }
    },
}
</script>

<style>

</style>