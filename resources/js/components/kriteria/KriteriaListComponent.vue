<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">{{ pageTitle }}

                        <div class="float-right">
                            <button class="btn btn-sm btn-primary" @click="toogleModal">    
                                <i class="fa fa-plus"></i> Add New Kriteria
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kriteria</th>
                                    <th scope="col">Field</th>
                                    <th scope="col">Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(role, index) in roles" :key="index" >
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ role.kriteria_name }}</td>         
                                    <td>{{ role.kriteria_field }}</td>                                    
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
                Add New Kriteria
                </h5>          
                <button type="button" class="close float-right" @click="toogleModal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="form-group">
                    <label for="roleName">Nama Kriteria</label>
                    <input type="text" class="form-control" id="roleName" v-model="kriteria_name">
                    <small class="text-danger" v-if="required" >Nama Kriteria is required.</small>                    
                </div>   
                <div class="form-group">
                    <label for="field_kriteria">Field</label>
                    <input type="text" class="form-control" id="field_kriteria" v-model="kriteria_field">
                    <small class="text-danger" v-if="required_field" >Kriteria Field is required.</small>                    
                </div>   
                <button type="submit" class="btn btn-primary" @click="insertKriteria">Submit</button>
            </div>            
        </modal>

        <modal v-if="show_modal_edit" :width="50" :custom_header="true"> 
            <div class="modal-header" slot="header">
                <h5 class="mb-0 header-primary">              
                Edit Kriteria
                </h5>          
                <button type="button" class="close float-right" @click="toogleModalEdit" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="form-group">
                    <label for="editKriteria">Nama Kriteria</label>
                    <input type="text" class="form-control" id="editKriteria" v-model="role_edit.kriteria_name">
                    <small class="text-danger" v-if="required" >Nama Kriteria is required.</small>                    
                </div>   
                <div class="form-group">
                    <label for="editFieldKriteria">Field</label>
                    <input type="text" class="form-control" id="editFieldKriteria" v-model="role_edit.kriteria_field">
                    <small class="text-danger" v-if="required_field" >Field Kriteria is required.</small>                    
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
            this.$store.dispatch('kriteria/getAllKriteria').then((response)=>{                
                this.roles = response
            })
        },
        insertKriteria(){            

            if(this.checkkriteria_name())
            {
                let data = {'kriteria_name': this.kriteria_name, 
                            'kriteria_field': this.kriteria_field}
                this.$store.dispatch('kriteria/insertKriteria', data).then((response)=>{
                    if(response)
                    {   
                        this.kriteria_name = ''
                        this.kriteria_field = ''
                        this.toogleModal()
                        alert('Kriteria '+data.kriteria_name+' telah ditambahkan')
                        this.init()
                    }
                    
                })
            }

        },      
        checkkriteria_name(){
            // console.log(this.kriteria_name)
            if(this.kriteria_name == '' && this.kriteria_field == ''  )
            {
                this.required = true
                this.required_field = true
                return false
            }
            else if(this.kriteria_name != '' && this.kriteria_field == ''  )
            {   
                this.required = false
                this.required_field = true
                return false
            }
            else if(this.kriteria_name == '' && this.kriteria_field != ''  )
            {   
                this.required = true
                this.required_field = false
                return false
            }
            else
            {
                this.required_field = false
                this.required = false
                return true
            }
        },
        deleteRole(idKriteria){
            if(confirm("Anda yakin ingin menghapus Kriteria ini? "))
            {
                let data = {'idKriteria' : idKriteria}
                this.$store.dispatch('kriteria/deleteKriteria', data).then((response)=>{
                       alert('Kriteria telah dihapus')
                       this.init()                
                })
            }
        },
        toogleModal()
        {
            this.show_modal = !this.show_modal
        },
        toogleModalEdit(idKriteria)
        {                        
            
            this.role_edit = {}
            if(this.show_modal_edit == false)
            {
                let data = {'idKriteria' : idKriteria }
                this.$store.dispatch('kriteria/getOneKriteria', data).then((response)=>{                                            
                    this.role_edit = response  
                    this.show_modal_edit = !this.show_modal_edit        
                })
            }else{
                 this.show_modal_edit = !this.show_modal_edit 
            }
                               
        },
        checkEditkriteria_name(){
            // console.log(this.kriteria_name)
            if(this.role_edit.kriteria_name == '' && this.role_edit.kriteria_field == '' )
            {
                this.required = true
                this.required_field = true
                return false
            }
            else if(this.role_edit.kriteria_name != '' && this.role_edit.kriteria_field == '')
            {   
                this.required = false
                this.required_field = true
                return false
            }
            else if(this.role_edit.kriteria_name == '' && this.role_edit.kriteria_field != '')
            {   
                this.required = true
                this.required_field = false
                return false
            }
            else
            {
                this.required_field = false
                this.required = false
                return true
            }
        },
        updateRole()
        {
            if(this.checkEditkriteria_name())
            {
                let data = this.role_edit                            
                this.$store.dispatch('kriteria/updateKriteria', data).then((response)=>{
                    if(response)
                    {                           
                        this.toogleModalEdit()
                        alert('Kriteria telah diubah')
                        this.init()
                    }
                    
                })            
            }
        }
    },
    data(){
        return{
            show_modal: false,            
            kriteria_name: '',        
            kriteria_field: '',   
            required: false,
            required_field: false,
            show_modal_edit: false,
            kriteria_name_edit: '',
            role_edit: {},
            roles: []
        }
    }
}
</script>
