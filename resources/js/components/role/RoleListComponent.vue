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
                                    <td>Edit | Delete</td>
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
                    <input type="text" class="form-control" id="roleName" aria-describedby="emailHelp">                    
                </div>   
                <button type="submit" class="btn btn-primary">Submit</button>
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
                console.log(response)
                this.roles = response
            })
        },
        toogleModal()
        {
            this.show_modal = !this.show_modal
        }
    },
    data(){
        return{
            show_modal: false,
            roles: []
        }
    }
}
</script>
