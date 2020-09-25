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
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
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
                <form-role></form-role>
            </div>            
        </modal>

    </div>
</template>

<script>
import RoleForm from './FormRoleComponent'
import Modal from '../globalComponent/ModalComponent'
export default {
    components:
    {
        'form-role': RoleForm,
        'modal': Modal
    },
    computed:{
        pageTitle() {   
            return this.$route.meta.title
            console.log(this.$route.meta.title);
        },
    },
    methods:{
        toogleModal()
        {
            this.show_modal = !this.show_modal
        }
    },
    data(){
        return{
            show_modal: false
        }
    }
}
</script>
