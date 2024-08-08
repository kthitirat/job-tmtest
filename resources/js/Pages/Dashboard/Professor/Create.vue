<template>
    <Layout>
        <ProfessorForm :departments="departments" mode="create"/>
    </Layout>
</template>

<script>

import Layout from "@/Pages/Dashboard/Layout/Layout.vue";
//import {Link} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";
import ProfessorForm from "@/Pages/Dashboard/Professor/ProfessorForm.vue";

export default {
    name:"CreateProfessor",
    components: {
        ProfessorForm,
        Layout
        
    },
    props:{
        departments: {
            type: Array,
            required: true
        },
     
    },
//     mounted() {         
//     },
//     data() {
//         return{
//             form:{
//                 image: null,
//                 code: null,
//                 name_th: null,
//                 name_en: null,
//                 unit: null,
//                 published_at: null,
//                 description: null,
//                 professors: [],
//                 documents: []
//             },
//             displaySubjectImage: null,
//             currentSelectingProfessor: ""

//         }
//     },
//     methods:{
//         handleRemoveDucument(index){
//             this.form.documents.splice(index, 1);
//         },
//         handleSubjectDocument(event){
//             const file = event.target.files[0];
//             this.form.documents.push(file);    
//         },
//         handleRemoveProfessor(index){           
//             this.form.professors.splice(index, 1);
//         },
//         handSelectProfessor(){
//             this.form.professors.push(this.currentSelectingProfessor);
//             this.currentSelectingProfessor = "";
//         },
//         handleSubjectImage(event) {
//             const image = event.target.files[0];
//             this.form.image = image;
//             const blob = new Blob([image], {type: image.type});
//             const blobUrl = URL.createObjectURL(blob);
//             this.displaySubjectImage = blobUrl;
//         },
//         submit(){
//             const url = this.route('dashboard.subjects.store'); 
//             router.post( url, {
//                 _method: 'post',
//                 image: this.form.image,
//                 code: this.form.code,
//                 name_th: this.form.name_th,
//                 name_en: this.form.name_en,
//                 unit: this.form.unit,
//                 published_at: this.form.published_at,
//                 description: this.form.description,
//                 professors: this.form.professors,
//                 documents: this.form.documents
//             })

//             // console.log('--------');
//             // console.log('ok');
//             // console.log('--------');
//         },
//         watch: {
//             form: {
//             handler: function () {
           
//             },
//             deep: true
//     }
//   }
//     }
}
</script>

<style scoped>

</style>

