<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">{{ pageTitle }}

                        <div class="float-right">
                            <a :href="'/hero/add'" class="btn btn-sm btn-primary" >    
                                <i class="fa fa-plus"></i> Add New Hero
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hero Name</th>
                                    <th scope="col">Role</th>                                    
                                    <th scope="col">Speciality</th>                                    
                                    <th scope="col">Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(hero, index) in heros" :key="index"  >
                                    <td>{{ index+1 }}</td>
                                    <td>{{ hero.name }}</td>
                                    <td>{{ hero.role }}</td>
                                    <td>{{ hero.speciality }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" @click="getDetail(hero._id)">Detail </button> 
                                        <button class="btn btn-warning btn-sm" @click="editHero(hero._id)">Edit </button> 
                                        <button class="btn btn-danger btn-sm" @click="deleteHero(hero._id)">Delete </button> 
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>

        <modal v-if="show_modal" :width="80" :custom_header="true"> 
            <div class="modal-header" slot="header">
                <h5 class="mb-0 header-primary">              
                Add New Role
                </h5>          
                <button type="button" class="close float-right" @click="toogleModalDetail" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>            
            </div>                
            <div slot="body">
                <div class="row">                    
                    <div class="col-4"> 
                        <img :src="detail.photo" alt="gambar herp" class="img-thumbnail">
                    </div>
                    <div class="col-8"> 
                        <div class="row">
                            <div class="col-8">
                                <h4><b>{{ detail.name }}</b></h4>
                                <h6><b>{{ detail.alias }}</b></h6>
                                <p class="mb-1">Role: {{ detail.role }}</p>
                                <p class="mb-1">Speciality: {{ detail.speciality }}</p>
                            </div>                                                                                                              
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="diff_hero">Difficulty</label>
                                    <vue-range ref="slider" v-model="detail.difficulty" tooltip="always" disabled="true" id="diff_hero"></vue-range>                                
                                </div>   
                                <div class="form-group">
                                    <label>Offense</label>
                                    <vue-range ref="slider" v-model="detail.offense" tooltip="always" disabled="true"></vue-range>                                
                                </div> 
                                <div class="form-group">
                                    <label>Skill Effect</label>
                                    <vue-range ref="slider" v-model="detail.skill_effect" tooltip="always" disabled="true"></vue-range>                                
                                </div>    
                                <div class="form-group">
                                    <label>Difficulty</label>
                                    <vue-range ref="slider" v-model="detail.difficulty" tooltip="always" disabled="true"></vue-range>                                
                                </div>    
                            </div>
                        </div>                                                
                    </div>
                    
                    <div class="col-12">
                        <hr>
                        <h4>Attributes</h4>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Movement Speed</label>
                                    <div>{{detail.attributes.move_speed}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Attack Speed</label>
                                    <div>{{detail.attributes.att_speed}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Base Att Crit Rate</label>
                                    <div>{{detail.attributes.base_att_crit_rate}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Ability Crit Rate</label>
                                    <div>{{detail.attributes.ability_crit_rate}}</div>
                                </div>                            
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Physical Attack</label>
                                    <div>{{detail.attributes.physical_att}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Physical Deffendse</label>
                                    <div>{{detail.attributes.physical_deff}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Hp</label>
                                    <div>{{detail.attributes.hp}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Hp Regen</label>
                                    <div>{{detail.attributes.hp_regen}}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Magic Power</label>
                                    <div>{{detail.attributes.magic_power}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Magic Deffendse</label>
                                    <div>{{detail.attributes.magic_deff}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Mana</label>
                                    <div>{{detail.attributes.mana}}</div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">Mana Regen</label>
                                    <div>{{detail.attributes.mana_regen}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </modal>

       
    </div>
</template>

<script>
// import RoleForm from './FormRoleComponent'
import Modal from '../globalComponent/ModalComponent'
import VueRangeSlider from 'vue-range-component'

import {mapGetters} from 'vuex';
import {createHelpers} from 'vuex-map-fields'

const {
  mapFields
} = createHelpers({
  getterType: 'hero/getField',
  mutationType: 'hero/UPDATE_FIELD',
});


export default {
    components:
    {        
        'modal': Modal,
        'vue-range' : VueRangeSlider
    },
    computed:{
        pageTitle() {   
            return this.$route.meta.title            
        },
        ...mapGetters({
            hero: 'hero/getHero'
        }),
    },
    created(){
        this.init();
    },
    methods:{
        init()
        {
            this.$store.dispatch('hero/getAllHero').then((response)=>{                
                this.heros = response
            })
        },                   
        getDetail(idHero)
        {
            console.log(idHero)                        
            let parent = this
            let data = {'idHero' : idHero}
            this.$store.dispatch('hero/getOneHero', data).then((response)=>{
            
                parent.detail = response
                parent.toogleModalDetail()
            })                
            
        },         
        toogleModalDetail()
        {
            this.show_modal = !this.show_modal
        },
        editHero(idHero)
        {
            this.$router.push({name:'admin.hero.edit', params:{idHero: idHero}})
        },
        deleteHero(idHero){
            console.log(idHero)
            if(confirm("Anda yakin ingin menghapus Hero ini? "))
            {
                let data = {'idHero' : idHero}
                this.$store.dispatch('hero/deleteHero', data).then((response)=>{
                       this.init()                
                })
            }
        }, 
        
    },
    data(){
        return{
            show_modal: false,            
            role_name: '',           
            required: false,            
            role_edit: {},
            heros: [],
            detail: null
        }
    }
}
</script>
