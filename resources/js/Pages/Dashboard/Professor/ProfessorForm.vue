<template>
         <form @submit.prevent="submit">
            <div class="w-full md:grid-cols-3 gap-2 p-4">
                    <button class="w-60 h-72 border border-dashed flex items-center justify-center"
                            type="button" @click="$refs.imageInputRef.click()">
                        <div v-if="displayProfessorImage === null">   <!--v-if="displaySubjectImage === null" ให้แสดงปุ่ม + -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <img v-if="displayProfessorImage!=null" :src="displayProfessorImage" class="w-full h-72 object-cover" >
                    </button>  
                    <input @change="handleSubjectImage" ref="imageInputRef" type="file" class="hidden" accept="image/*">  
                    <p class="text-red-500 text-sm">{{ $page.props.errors.image }}</p>          
                </div> 
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4 p-4">                
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">คำนำหน้า</span>                    
                        </div>
                        <input v-model="form.prefix" type="text" placeholder="คำนำหน้า" class="input input-bordered w-full" />    
                        <p class="text-red-500 text-sm">{{ $page.props.errors.prefix }}</p>          
                    </label>
                </div>   
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">ชื่อ</span>                    
                        </div>
                        <input v-model="form.first_name" type="text" placeholder="ชื่อ" class="input input-bordered w-full" /> 
                        <p class="text-red-500 text-sm">{{ $page.props.errors.first_name }}</p>                 
                    </label>
                </div> 
                <div class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">นามสกุล</span>                    
                        </div>
                        <input v-model="form.last_name" type="text" placeholder="นามสกุล" class="input input-bordered w-full" /> 
                        <p class="text-red-500 text-sm">{{ $page.props.errors.last_name }}</p>                
                    </label>
                </div>          
            </div>      
            <div class="w-full md:grid-cols-3 gap-2 p-4">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">เลือกคณะ</span>                        
                    </div>
                    <select v-model="form.department_id" class="select select-bordered">
                        <option value="">เลือกคณะ</option>
                        <option v-for="department in departments" :key="department.id" :value="department.id">
                            {{ department.name }}
                        </option>
                    </select>              
                </label>
            </div>
            <p class="text-red-500 text-sm">{{ $page.props.errors.department_id }}</p>              
            <div class="col-span-3 w-full flex justify-end mt-4">
                <button class="uppercase btn btn-primary">Submit</button>
            </div>     
        </form>
</template>

<script>
import {router} from "@inertiajs/vue3";
export default {
    name: 'ProfessorForm',
    props:{
        departments: {
            type: Array,
            required: true
        },
        professor:{
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
                prefix: null,
                first_name: null,
                last_name: null,
                department_id: null
                
            },
            displayProfessorImage: null,
         
        }
    },
    mounted() {
        if (this.mode === 'create') {           //อันนี้โหมด create
            return;
        }
        if (this.professor.image.data.length > 0) {        //อันนี้โหมด edit
            this.displayProfessorImage = this.professor.image.data[0].url;
        }
        this.form.prefix = this.professor.prefix;
        this.form.first_name = this.professor.first_name;
        this.form.last_name = this.professor.last_name;
        this.form.department_id = this.professor.department_id;
       
    },
    methods:{

        handleSubjectImage(event) {
            const image = event.target.files[0];
            this.form.image = image;
            const blob = new Blob([image], {type: image.type});
            const blobUrl = URL.createObjectURL(blob);
            this.displayProfessorImage = blobUrl;
        },  

        submit(){
            let url = this.route('dashboard.professors.store');
            if (this.mode === 'edit') {
                url = this.route('dashboard.professors.update', this.professor.id);
            }
            router.post( url, {
                _method: this.mode === 'create' ? 'POST' : 'PATCH',
                image: this.form.image,
                prefix: this.form.prefix,
                first_name: this.form.first_name,
                last_name: this.form.last_name,
                department_id: this.form.department_id,
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