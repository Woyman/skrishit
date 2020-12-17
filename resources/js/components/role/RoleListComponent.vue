<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">{{ pageTitle }}

                        <div class="float-right">
                            <button class="btn btn-sm btn-primary" @click="toogleModal">    
                                <i class="fa fa-plus"></i> Add New Role
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(role, index) in roles" :key="index" >
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ role.role_name }}</td>                                    
                                    <td> <button class="btn btn-info btn-sm" @click="toogleModalEdit(role._id)"><i class="fa fa-edit text-white"></i> Edit</button> | 
                                         <button class="btn btn-outline-danger btn-sm" @click="deleteRole(role._id)"><i class="fa fa-times"></i> Delete</button></td>
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
                Add New Role
                </h5>          
                <button type="button" class="close float-right" @click="toogleModal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="form-group">
                    <label for="roleName">Nama Role</label>
                    <input type="text" class="form-control" id="roleName" v-model="role_name">
                    <small class="text-danger" v-if="required" >Nama Role is required.</small>                    
                </div>   
                <button type="submit" class="btn btn-primary" @click="insertRole">Submit</button>
            </div>            
        </modal>

        <modal v-if="show_modal_edit" :width="50" :custom_header="true"> 
            <div class="modal-header" slot="header">
                <h5 class="mb-0 header-primary">              
                Edit Role
                </h5>          
                <button type="button" class="close float-right" @click="toogleModalEdit" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="form-group">
                    <label for="roleName">Nama Role</label>
                    <input type="text" class="form-control" id="roleName" v-model="role_edit.role_name">
                    <small class="text-danger" v-if="required" >Nama Role is required.</small>                    
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
            this.$store.dispatch('role/getAllRole').then((response)=>{                
                this.roles = response
            })
        },
        insertRole(){            

            if(this.checkRole_name())
            {
                let data = {'role_name': this.role_name}
                this.$store.dispatch('role/insertRole', data).then((response)=>{
                    if(response)
                    {   
                        this.role_name = ''
                        this.toogleModal()
                        alert('Role '+data.role_name+' ditambakan')
                        this.init()
                    }
                    
                })
            }

        },      
        checkRole_name(){
            // console.log(this.role_name)
            if(this.role_name == '' )
            {
                this.required = true
                return false
            }else{
                this.required = false
                return true
            }
        },
        deleteRole(idRole){
            if(confirm("Anda yakin ingin menghapus Role ini? "))
            {
                let data = {'idRole' : idRole}
                this.$store.dispatch('role/deleteRole', data).then((response)=>{                    
                       this.init()                
                       alert('role telah dihapuskan')
                })
            }
        },
        toogleModal()
        {
            this.show_modal = !this.show_modal
        },
        toogleModalEdit(idRole)
        {                        
            this.role_edit = {}
            if(this.show_modal_edit == false)
            {
                let data = {'idRole' : idRole }
                this.$store.dispatch('role/getOneRole', data).then((response)=>{   
                                        
                    this.role_edit = response  
                    this.show_modal_edit = !this.show_modal_edit        
                })
            }else{
                 this.show_modal_edit = !this.show_modal_edit 
            }
                               
        },
        checkEditRole_name(){
            // console.log(this.role_name)
            if(this.role_edit.role_name == '' )
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
                let data = this.role_edit                            
                this.$store.dispatch('role/updateRole', data).then((response)=>{
                    if(response)
                    {                           
                        this.toogleModalEdit()
                        alert('role telah diubah')
                        this.init()
                    }
                    
                })            
            }
        }
    },
    data(){
        return{
            show_modal: false,            
            role_name: '',           
            required: false,
            show_modal_edit: false,
            role_name_edit: '',
            role_edit: {},
            roles: []
        }
    }
}
</script>
