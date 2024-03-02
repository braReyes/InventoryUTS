<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head,useForm } from '@inertiajs/vue3';
import { nextTick,ref } from 'vue';
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



const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const columna2 = ref([]);
const boton1 = ref([]);
const boton2 = ref([]);
const reporte = ref('1');
const tipo = ref([{'id':'1','name':'Prestamos'},{'id':'2','name':'Recurso Audiovisual'}]);

columna2.value= [{data:null,render:function(data,type,row,meta)
    {return (meta.row + 1)}},
    {data:'name'}
]
boton1.value= [
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

boton2.value= [
    {
        title:'Departments',extend:'excelHtml5', 
        text:'<i class="fa-solid fa-file-excel"></i> Excel',
        className:'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Departments',extend:'pdfHtml5', 
        text:'<i class="fa-solid fa-file-pdf"></i> PDF',
        className:'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Departments',extend:'print', 
        text:'<i class="fa-solid fa-print"></i> IMPRIMIR',
        className:'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Departments',extend:'copy', 
        text:'<i class="fa-solid fa-copy"></i> COPIAR',
        className:'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    }
]

const props = defineProps({
    employees: {type:Object},
    departments: {type:Object}
});
const form = useForm({
    name:'', email:'',phone:'',aula:'',department_id:''
});


const openModal = (op,name,email,phone,aula,department,employee) =>{
    modal.value = true;
    nextTick( () => nameInput.value.focus());
    operation.value = op;
    id.value = employee;
    if(op == 1){
        title.value = 'Crear Prestamo';
    }
    else{
        title.value = 'Editar Prestamo';
        form.name=name;
        form.email=email;
        form.phone=phone;
        form.aula=aula;
        form.department_id=department;
    }
}
const closeModal = () =>{
    modal.value = false;
    form.reset();
}

const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
    
}
const save = () => {
  if (operation.value == 1) {
    form.post(route('employees.store'), {
      onSuccess: () => {
        ok('Employee created');

        setTimeout(() => {
          location.reload(); 
        }, 2000); 
      }
    });
  } else {
    form.put(route('employees.update', id.value), {
      onSuccess: () => {
        ok('Employee updated');

        setTimeout(() => {
          location.reload(); 
        }, 2000); 
      }
    });
  }
};

const deleteEmployee = (id, name) => {
  const alerta = Swal.mixin({
    buttonsStyling: true
  });
  alerta.fire({
    title: 'Seguro que quiere eliminar estudiante ' + name + ' ?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '<i class="fa-solid fa-check"></i> Yes, delete',
    cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      form.delete(route('employees.destroy', id), {
        onSuccess: () => {
          ok('Employee deleted');

          setTimeout(() => {
            location.reload(); 
          }, 2000); 
        }
      });
    }
  });
};


</script>

<template>
    <Head title="Prestamos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Prestamos</h2>
        </template>

        <div class="py-12">
        <div class="bg-white grid v-screen place-items-center">
            <div v-if="reporte === '1'" class="mt-3 mb-3 flex">
                <PrimaryButton @click="openModal(1)">
                    <i class="fa-solid fa-plus-circle"></i> Agregar
                </PrimaryButton>
            </div>
        </div>
            <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <InputLabel for="rep" Value="Report:"></InputLabel>
                    <SelectInput id="rep" class="mt-1 block w-3/4"
                    v-model="reporte" :options="tipo"></SelectInput>
                </div>
         
            <div v-if="reporte == '1'" class="bg-white grid v-screen place-items-center overflow-x-auto py-3">
                <DataTable class="display" 
                :options="{responsive:true, autoWidth:false,dom:'Bfrtip',buttons:boton1, paging: true, pageLength: 10 }">
                    
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">NOMBRE</th>
                            <th class="px-2 py-2">EMAIL</th>
                            <th class="px-2 py-2">TEL</th>
                            <th class="px-2 py-2">AULA</th>
                            <th class="px-2 py-2">RECURSO</th>
                            <th class="px-2 py-2"></th>
<!--                             <th class="px-2 py-2"></th>
 -->                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="emp, i in employees.data" :key="emp.id">
                        <td class="border border-gray-400 px-2 py-2">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.name }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.email }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.phone }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.aula }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.department }}</td>
                        <td class="border border-gray-400 px-2 py-2">
                            <WarningButton 
                            @click="openModal(2,emp.name,emp.email,emp.phone,emp.aula,emp.department_id,emp.id)">
                                <i>Editar</i>
                            </WarningButton>
                        </td>
                        <!-- <td class="border border-gray-400 px-2 py-2">
                            <DangerButton @click="deleteEmployee(emp.id,emp.name)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td> -->
                        </tr>
                    </tbody>
                </DataTable>
            </div>
            <div v-else class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :data="departments" :columns="columna2"
                    class="w-full border border-gray-400" 
                    :options="{responsive:true, autoWidth:false,dom:'Bfrtip',buttons:boton2}">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">NOMBRE</th>
                        </tr>
                    </thead>
                    </DataTable>
                </div>
            
        </div>
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
            <div class="p-3 mt-6">
                <InputLabel for="name" value="Name:"></InputLabel>
                <TextInput id="name" ref="nameInput"
                v-model="form.name" type="text" class="mt-1 block w-3/4"
                placeholder="Name"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="email" value="Email:"></InputLabel>
                <TextInput id="email"
                v-model="form.email" type="text" class="mt-1 block w-3/4"
                placeholder="Email"></TextInput>
                <InputError :message="form.errors.email" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="phone" value="Phone:"></InputLabel>
                <TextInput id="phone"
                v-model="form.phone" type="text" class="mt-1 block w-3/4"
                placeholder="Phone"></TextInput>
                <InputError :message="form.errors.phone" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="aula" value="Aula:"></InputLabel>
                <TextInput id="aula"
                v-model="form.aula" type="text" class="mt-1 block w-3/4"
                placeholder="Aula"></TextInput>
                <InputError :message="form.errors.email" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="department_id" value="Recurso:"></InputLabel>
                <SelectInput id="department_id" :options="departments"
                v-model="form.department_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.department_id" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-6">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <i class="fa-solid fa-save"></i> Save
                </PrimaryButton>
            </div>
            <div class="p-3 mt-6 flex justify-end">
                <SecondaryButton class="ml-3" :disabled="form.processing"
                @click="closeModal">
                    Cancel
                </SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
