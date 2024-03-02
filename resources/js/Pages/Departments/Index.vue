<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import DataTable from 'datatables.net-vue3';
import 'datatables.net-dt/css/jquery.dataTables.css';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-responsive-dt';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfmake from "pdfmake/build/pdfmake";
import * as pdfFonts from "pdfmake/build/vfs_fonts";
pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;
window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);



const props = defineProps({
    departments: {type:Object}
});

const form = useForm({
    est: props.departments.est,
    id:''
});

const btn = ref([]);

btn.value= [
    {
        title:'Employees',extend:'excelHtml5', 
        text:'<i class="fa-solid fa-file-excel"></i> Excel',
        className:'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Employees',extend:'pdfHtml5', 
        text:'<i class="fa-solid fa-file-pdf"></i> PDF',
        className:'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Employees',extend:'print', 
        text:'<i class="fa-solid fa-print"></i> IMPRIMIR',
        className:'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Employees',extend:'copy', 
        text:'<i class="fa-solid fa-copy"></i> COPIAR',
        className:'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    }
]


const deleteDepartment = (id,name) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Are you sure delete '+name+' ?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Yes,delete',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancel'
    }).then((result) => {
    if (result.isConfirmed) {
      form.delete(route('departments.destroy', id), {
        onSuccess: () => {
          ok('Employee deleted');

          setTimeout(() => {
            location.reload(); 
          }, 100); 
        }
      });
    }
  });
}


const ok = (msj) =>{
    form.reset();  
}

const formatDate = (date) => {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    return new Date(date).toLocaleDateString(undefined, options);
}





</script>




<template>
    <Head title="Recursos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recursos</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('departments.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                    <i class="fa-solid fa-plus-circle"></i> Agregar
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <DataTable :options="{responsive:true, autoWidth:false,dom:'Bfrtip',buttons:btn}">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-4">#</th>
                            <th class="px-4 py-4">Recursos</th>
                            <th class="px-4 py-4">Fecha De Ingreso</th>
                            <th class="px-4 py-4">Fecha Actualizacion</th>
                            <th class="px-4 py-4">Cantidad</th>
                            <th class="px-4 py-4">Estado</th>
                            <th class="px-4 py-4"></th>
                            <th class="px-4 py-4"></th>
<!--                             <th class="px-4 py-4"></th>
 -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dep, i in departments" :key="dep.id" :class="{ 'inactive-activo': dep.est === 0 }">
                            <td class="border border-gray-400 px-4 py-4">{{ (i+1) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ dep.name }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ formatDate(dep.created_at) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ formatDate(dep.updated_at) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ dep.count }}</td>
                            <td class="border border-gray-400 px-4 py-4" :class="{ 'inactive-text': dep.est === 0, 'activo': dep.est === 1 }">{{ dep.est === 1 ? 'Activo' : 'Inactivo' }}</td>
                            <td class="border border-gray-400 px-4 py-4">
                                <a :href="route('departments.estado', { department: dep.id })" class="px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs">
                                    <i>Cambiar Estado</i>
                                </a>

                            </td>
                            <td class="border border-gray-400 px-4 py-4">
                                <Link :href="route('departments.edit', dep.id)"  v-if="dep.est === 1" :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                                    <i class="fa-solid fa-edit"></i>
                                </Link>
                            </td>
                            <!-- <td class="border border-gray-400 px-4 py-4">
                                <DangerButton @click="deleteDepartment(dep.id, dep.name)" v-if="dep.est === 1">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>
                            </td> -->
                        </tr>
                    </tbody>
                </DataTable>
            </div>
        </div>        
    </AuthenticatedLayout>
</template>
<style>
    /* .inactive-activo {
    opacity: 0.3;
    } */
    .inactive-text {
    
    color: rgb(175, 35, 35); 
    }

    .activo{
        color: green;
    }

</style>
