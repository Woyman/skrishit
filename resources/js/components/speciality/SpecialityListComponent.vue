<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">{{ pageTitle }}

                        <div class="float-right">
                            <button class="btn btn-sm btn-primary" @click="toogleModal">    
                                <i class="fa fa-plus"></i> Add New Speciality
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Speciality Name</th>
                                    <th scope="col">Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(speciality, index) in specialities" :key="index" >
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ speciality.speciality_name }}</td>                                    
                                    <td> <button class="btn btn-info btn-sm" @click="toogleModalEdit(speciality._id)"><i class="fa fa-edit text-white"></i> Edit</button> | 
                                         <button class="btn btn-outline-danger btn-sm" @click="deleteRole(speciality._id)"><i class="fa fa-times"></i> Delete</button></td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>

        <modal v-if="show_modal" :width="50" :custom_header="true"> 
            <div class="modal-header" slot="header">
                <h5 class="mb-0 header-primary">              
                Add New Speciality
                </h5>          
                <button type="button" class="close float-right" @click="toogleModal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="form-group">
                    <label for="roleName">Nama Speciality</label>
                    <input type="text" class="form-control" id="roleName" v-model="speciality_name">
                    <small class="text-danger" v-if="required" >Nama Speciality is required.</small>                    
                </div>   
                <button type="submit" class="btn btn-primary" @click="insertRole">Submit</button>
            </div>            
        </modal>

        <modal v-if="show_modal_edit" :width="50" :custom_header="true"> 
            <div class="modal-header" slot="header">
                <h5 class="mb-0 header-primary">              
                Edit Speciality
                </h5>          
                <button type="button" class="close float-right" @click="toogleModalEdit" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="form-group">
                    <label for="roleName">Nama Speciality</label>
                    <input type="text" class="form-control" id="roleName" v-model="speciality_edit.speciality_name">
                    <small class="text-danger" v-if="required" >Nama Speciality is required.</small>                    
                </div>   
                <button type="submit" class="btn btn-primary" @click="updateRole">Submit</button>
            </div>            
        </modal>

    </div>
</template>

<script>
// import RoleForm from './FormRoleComponent'
import Modal from '../globalComponent/ModalComponent'

import {mapGetters} from 'vuex';
import {createHelpers} from 'vuex-map-fields'

const {
  mapFields
} = createHelpers({
  getterType: 'role/getField',
  mutationType: 'role/UPDATE_FIELD',
});

export default {
    components:
    {        
        'modal': Modal
    },
    computed:{
        pageTitle() {   
            return this.$route.meta.title            
        },
    },
    created(){
        this.init();
    },
    methods:{
        init()
        {
            this.$store.dispatch('speciality/getAllSpeciality').then((response)=>{                
                this.specialities = response
            })
        },
        insertRole(){            

            if(this.checkRole_name())
            {
                let data = {'speciality_name': this.speciality_name}
                this.$store.dispatch('speciality/insertSpeciality', data).then((response)=>{
                    if(response)
                    {   
                        this.speciality_name = ''
                        this.toogleModal()
                        alert('Speciality '+data.speciality_name+' telah ditambahkan')
                        this.init()
                    }
                    
                })
            }

        },      
        checkRole_name(){
            // console.log(this.role_name)
            if(this.speciality_name == '' )
            {
                this.required = true
                return false
            }else{
                this.required = false
                return true
            }
        },
        deleteRole(idSpeciality){
            if(confirm("Anda yakin ingin menghapus Speciality ini? "))
            {
                let data = {'idSpeciality' : idSpeciality}
                this.$store.dispatch('speciality/deleteSpeciality', data).then((response)=>{
                       this.init()                
                       alert('Speciality telah dihapus')
                })
            }
        },
        toogleModal()
        {
            this.show_modal = !this.show_modal
        },
        toogleModalEdit(idSpeciality)
        {                        
            this.role_edit = {}
            if(this.show_modal_edit == false)
            {
                let data = {'idSpeciality' : idSpeciality }
                this.$store.dispatch('speciality/getOneSpeciality', data).then((response)=>{   
                                        
                    this.speciality_edit = response  
                    this.show_modal_edit = !this.show_modal_edit        
                })
            }else{
                 this.show_modal_edit = !this.show_modal_edit 
            }
                               
        },
        checkEditRole_name(){
            // console.log(this.role_name)
            if(this.speciality_edit.speciality_name == '' )
            {
                this.required = true
                return false
            }else{
                this.required = false
                return true
            }
        },
        updateRole()
        {
            if(this.checkEditRole_name())
            {
                let data = this.speciality_edit                            
                this.$store.dispatch('speciality/updateSpeciality', data).then((response)=>{
                    if(response)
                    {                           
                        this.toogleModalEdit()
                        alert('Speciality telah diubah')
                        this.init()
                    }
                    
                })            
            }
        }
    },
    data(){
        return{
            show_modal: false,            
            speciality_name: '',           
            required: false,
            show_modal_edit: false,            
            speciality_edit: {},
            specialities: []
        }
    }
}
</script>
