<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 mt-3">
                <div class="card">
                    <div class="card-header"><b>{{ pageTitle }}</b></div>
                    <div class="card-body">     
                        <div class="row">                            
                            <div class="m-3" style="float: left; display: block; cursor: pointer;" v-for="(hero, index) in heros" :key="index" @click="getDetail(hero._id)">                                
                                <div class="img-thumbnail" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; text-align: center; display: flex">
                                    <img :src="hero.photo" style="width: 100px; height: 120px; top:-10%; left: -5%; position: relative" >
                                </div>
                                <center>{{hero.name}}</center>
                            </div>
                        </div>                   
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
                        <img :src="'/'+detail.photo" alt="gambar herp" class="img-thumbnail">
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
                                    <label for="diff_hero">Durability</label>
                                    <vue-range ref="slider" v-model="detail.durability" tooltip="always" disabled="true" id="diff_hero"></vue-range>                                
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
            this.$store.dispatch('electre/getAllHero').then((response)=>{                
                this.heros = response
            })            
        },                   
        getDetail(idHero)
        {
            console.log(idHero)                        
            let parent = this
            let data = {'idHero' : idHero}
            this.$store.dispatch('electre/getOneHero', data).then((response)=>{
            
                parent.detail = response
                parent.toogleModalDetail()
            })                
            
        },         
        toogleModalDetail()
        {
            this.show_modal = !this.show_modal
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
