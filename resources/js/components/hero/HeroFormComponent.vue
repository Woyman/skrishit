<template>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">{{ pageTitle }}
                       
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">     
                                <div class="col-6">                           
                                    <div class="form-group">
                                        <label for="nama_hero">Nama Hero</label>
                                        <input type="text" class="form-control" v-model="hero.name" :class="[{'is-invalid' : errors.name }]"  id="nama_hero" placeholder="Aldous">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="alias_hero">Alias Hero</label>
                                        <input type="text" class="form-control" v-model="hero.alias" :class="[{'is-invalid' : errors.alias }]" id="alias_hero" placeholder="Queen of the Apocalypse">
                                    </div>
                                </div>
                                <div class="col-12">                           
                                    <div class="form-group">
                                        <label for="role_hero">Role Hero</label>
                                        
                                        <multiselect v-model="hero.role" :options="roleOption" :class="[{'form-control invalid' : errors.role }]" :taggable="true" :multiple="true" @tag="multipleTagRole" id="role_hero"> </multiselect>                                        
                                        <div class="invalid-feedback" v-if="errors.role !== null " style="display:unset">Pilih salah satu</div>
                                    </div>
                                </div>
                                <div class="col-12">                           
                                    <div class="form-group" :class="[{'invalid' : errors.speciality }]">
                                        <label for="speciality_hero">Speciality Hero</label>
                                        <multiselect v-model="hero.speciality" :options="specialityOption" :class="[{'form-control invalid' : errors.speciality }]"  :taggable="true" :multiple="true" @tag="multipleTagRole" id="speciality_hero"> </multiselect>
                                        <div class="invalid-feedback" v-if="errors.speciality !== null " style="display:unset">Pilih salah satu</div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-6">      
                                    <div class="form-group">
                                        <label for="customFile">Gambar Hero</label>                     
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" ref="fileInput" :class="[{'is-invalid' : errors.photo }]" accept="image/*" id="customFile" @input="getPict($event.target.files)" >
                                            <label class="custom-file-label" for="customFile">{{ hero.photo_name }}</label>
                                        </div>
                                        <small v-if="idHero" style="font-size: 70%">Pilih untuk mengganti gambar sebelumnya</small>
                                        <div class="invalid-feedback" v-if="errors.photo !== null " style="display:unset">Gambar belum dipilih.</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                        <div class="pict_hero_here">
                                            <img :src="'../../../'+hero.photo"  style="max-width: 250px; mas-heigth: 250px" v-if="idHero && imgUrl == null ">
                                            <img :src="imgUrl"  style="max-width: 250px; mas-heigth: 250px" v-else>
                                        </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="durability_hero">Durability</label>
                                        <vue-range ref="slider" v-model="hero.durability" :class="[{'form-control invalid' : errors.durability }]" tooltip="hover" id="durability_hero"></vue-range>
                                        <div class="invalid-feedback" v-if="errors.durability !== null " style="display:unset">Nilai harus lebih dari '0'</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="offense_hero">Offense</label>
                                        <vue-range ref="slider" v-model="hero.offense" :class="[{'form-control invalid' : errors.offense }]" tooltip="hover" id="offense_hero"></vue-range>
                                        <div class="invalid-feedback" v-if="errors.offense !== null " style="display:unset">Nilai harus lebih dari '0'</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="skill_eff_hero">Skill Effect</label>
                                        <vue-range ref="slider" v-model="hero.skill_effect" :class="[{'form-control invalid' : errors.skill_effect }]" tooltip="hover" id="skill_eff_hero"></vue-range>
                                        <div class="invalid-feedback" v-if="errors.skill_effect !== null " style="display:unset">Nilai harus lebih dari '0'</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="diff_hero">Difficulty</label>
                                        <vue-range ref="slider" v-model="hero.difficulty" :class="[{'form-control invalid' : errors.difficulty }]" tooltip="hover" id="diff_hero"></vue-range>
                                        <div class="invalid-feedback" v-if="errors.difficulty !== null " style="display:unset">Nilai harus lebih dari '0'</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="moveSpeed_hero">Movement Speed</label>
                                        <input type="number" min="0" v-model="hero.attributes.move_speed" :class="[{'is-invalid' : errors.move_speed }]" class="form-control" id="moveSpeed_hero">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="physAtt_hero">Physical Attack</label>
                                        <input type="number" min="0" v-model="hero.attributes.physical_att" :class="[{'is-invalid' : errors.physical_att }]" class="form-control" id="physAtt_hero">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="MagicPow_hero">Magic Power</label>
                                        <input type="number" min="0"  v-model="hero.attributes.magic_power" :class="[{'is-invalid' : errors.magic_power }]" class="form-control" id="MagicPow_hero">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="attSpeed_hero">Attack Speed</label>
                                        <input type="number" min="0" step="0.01" v-model="hero.attributes.att_speed" :class="[{'is-invalid' : errors.att_speed }]" class="form-control" id="attSpeed_hero">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="physDeff_hero">Physical Defence</label>
                                        <input type="number" min="0" v-model="hero.attributes.physical_deff" :class="[{'is-invalid' : errors.physical_deff }]" class="form-control" id="physDeff_hero">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="MagicDeff_hero">Magic Defence</label>
                                        <input type="number" v-model="hero.attributes.magic_deff" :class="[{'is-invalid' : errors.magic_deff }]" class="form-control" id="MagicDeff_hero">
                                    </div>
                                </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="baseAttCritRate_hero">Basic Atk Crit Rate</label>
                                        <input type="number" min="0" v-model="hero.attributes.base_att_crit_rate" :class="[{'is-invalid' : errors.base_att_crit_rate }]" class="form-control" id="baseAttCritRate_hero">
                                    </div>
                                </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="hp_hero">Hp </label>
                                        <input type="number" min="0" v-model="hero.attributes.hp" :class="[{'is-invalid' : errors.hp }]" class="form-control" id="hp_hero">
                                    </div>
                                </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="mana_hero">Mana</label>
                                        <input type="number" min="0" v-model="hero.attributes.mana" :class="[{'is-invalid' : errors.mana }]" class="form-control" id="mana_hero">
                                    </div>
                                </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="abilCritRate_hero">Ability Crit Rate</label>
                                        <input type="number" min="0" v-model="hero.attributes.ability_crit_rate" :class="[{'is-invalid' : errors.ability_crit_rate }]" class="form-control" id="abilCritRate_hero">
                                    </div>
                                </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="hpRegen_hero">Hp Regen</label>
                                        <input type="number" min="0" v-model="hero.attributes.hp_regen" :class="[{'is-invalid' : errors.hp_regen }]" class="form-control" id="hpRegen_hero">
                                    </div>
                                </div>
                                 <div class="col-4">
                                    <div class="form-group">
                                        <label for="manaRegen_hero">Mana Regen</label>
                                        <input type="number" min="0" v-model="hero.attributes.mana_regen" :class="[{'is-invalid' : errors.mana_regen }]" class="form-control" id="manaRegen_hero">
                                    </div>
                                </div>

                            </div>
                            <div class="float-right">
                                <button class="btn btn-primary" @click="validate" >    
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>        
       
    </div>
</template>

<style>
.form-control.invalid{
    border-color: #dc3545 !important;
    height: unset;
    padding: unset;
}

/* .vue-range-slider.invalid{
    border-color: #dc3545 !important;

} */

</style>

<script>
// import RoleForm from './FormRoleComponent'
import Multiselect from 'vue-multiselect'
import VueRangeSlider from 'vue-range-component'
import 'vue-range-component/dist/vue-range-slider.css'
import {Validator} from 'simple-vue-validator'

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
        'multiselect': Multiselect,
        'vue-range' : VueRangeSlider
    },
    computed:{
        pageTitle() {   
            return this.$route.meta.title            
        },
        //  ...mapFields({
        //     hero: 'hero',            
        // }),
        ...mapGetters({
            hero: 'hero/getHero'
        }),
        errors() {
            return {
                name: this.validation.firstError('hero.name'),
                alias: this.validation.firstError('hero.alias'),
                role: this.validation.firstError('hero.role'),
                speciality: this.validation.firstError('hero.speciality'),
                durability: this.validation.firstError('hero.durability'),
                offense: this.validation.firstError('hero.offense'),
                skill_effect: this.validation.firstError('hero.skill_effect'),
                difficulty: this.validation.firstError('hero.difficulty'),
                move_speed: this.validation.firstError('hero.attributes.move_speed'),
                att_speed: this.validation.firstError('hero.attributes.att_speed'),
                base_att_crit_rate: this.validation.firstError('hero.attributes.base_att_crit_rate'),
                ability_crit_rate: this.validation.firstError('hero.attributes.ability_crit_rate'),
                physical_att: this.validation.firstError('hero.attributes.physical_att'),
                physical_deff: this.validation.firstError('hero.attributes.physical_deff'),
                hp: this.validation.firstError('hero.attributes.hp'),
                hp_regen: this.validation.firstError('hero.attributes.hp_regen'),
                magic_power: this.validation.firstError('hero.attributes.magic_power'),
                magic_deff: this.validation.firstError('hero.attributes.magic_deff'),
                mana: this.validation.firstError('hero.attributes.mana'),
                mana_regen: this.validation.firstError('hero.attributes.mana_regen'),
                photo: this.validation.firstError('hero.photo'),
            }
        }
    },   
    validators: {
        'hero.name': function (value) {
            return Validator.value(value).required()
        },
        'hero.alias': function (value) {
            return Validator.value(value).required()
        },
        'hero.role': function (value) {
            return Validator.value(value).required()
        },
        'hero.speciality': function (value) {
            return Validator.value(value).required()
        },
        'hero.durability': function (value) {
            return Validator.value(value).required().greaterThan(0)
        },
        'hero.offense': function (value) {
            return Validator.value(value).required().greaterThan(0)
        },
        'hero.skill_effect': function (value) {
            return Validator.value(value).required().greaterThan(0)
        },
        'hero.difficulty': function (value) {
            return Validator.value(value).required().greaterThan(0)
        },
        'hero.attributes.move_speed': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.att_speed': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.base_att_crit_rate': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.ability_crit_rate': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.physical_att': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.physical_deff': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.hp': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.hp_regen': function (value) {
            return Validator.value(value).required()
        },        
        'hero.attributes.magic_power': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.magic_deff': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.mana': function (value) {
            return Validator.value(value).required()
        },
        'hero.attributes.mana_regen': function (value) {
            return Validator.value(value).required()
        },
        'hero.photo': function (value) {
            return Validator.value(value).required()
        },
    },
    created(){
        this.init();
    },
    methods:{
        init()
        {
            parent = this
            // console.log(this.hero)
            this.$store.dispatch('role/getAllRole').then((response)=>{             
                
                response.forEach(function(res, index){
                    
                    parent.roleOption.push(res.role_name)                    
                })
                                                
            })
            this.$store.dispatch('speciality/getAllSpeciality').then((response)=>{                
                
                response.forEach(function(res, index){
                    parent.specialityOption.push(res.speciality_name)                                        
                })
                                                                
            })
            if(this.$route.params.idHero)
            {
                let data = {idHero: this.$route.params.idHero}
                this.$store.dispatch('hero/setHero', data)
                this.idHero = this.$route.params.idHero

            }
            // console.log(this.hero)
        },
        multipleTagRole (newTag) {
            const tag = {
                name: newTag                
            }
            this.options.push(tag)
            this.value.push(tag)
        },
        getPict(files)
        {
            console.log(files);       
            
            if(this.$route.params.idHero)
            {
                this.hero.old_photo = this.hero.photo
            }
            
            this.hero.photo = files[0];
            this.hero.photo_name = files[0].name
            this.imgUrl = URL.createObjectURL(files[0]);    
            // this.imgName = file.name            
        },
        validate()
        {            
            let parent = this
            this.$validate().then(function (success) {                
                if (success) {
                    parent.submitData()
                }          
            });
        },
        submitData()
        {
            parent = this            
            let data = new FormData()
            var hero = this.hero

            if(this.$route.params.idHero)
            {
                data.append('_id', this.$route.params.idHero)
                data.append('old_photo', hero.old_photo)
            }

            data.append('name', hero.name)
            data.append('alias', hero.alias)
            data.append('photo', hero.photo)

            hero.role.forEach((role) => data.append("role[]", role))
            hero.speciality.forEach((speciality) => data.append("speciality[]", speciality))            
            
            data.append('durability', hero.durability)
            data.append('offense', hero.offense)
            data.append('skill_effect', hero.skill_effect)
            data.append('difficulty', hero.difficulty)
            data.append('attributes[move_speed]', hero.attributes.move_speed)
            data.append('attributes[att_speed]', hero.attributes.att_speed)
            data.append('attributes[ability_crit_rate]', hero.attributes.ability_crit_rate)
            data.append('attributes[base_att_crit_rate]', hero.attributes.base_att_crit_rate)
            data.append('attributes[physical_att]', hero.attributes.physical_att)
            data.append('attributes[physical_deff]', hero.attributes.physical_deff)
            data.append('attributes[hp]', hero.attributes.hp)
            data.append('attributes[hp_regen]', hero.attributes.hp_regen)
            data.append('attributes[magic_power]', hero.attributes.magic_power)
            data.append('attributes[magic_deff]', hero.attributes.magic_deff)
            data.append('attributes[mana]', hero.attributes.mana)
            data.append('attributes[mana_regen]', hero.attributes.mana_regen)
            
            console.log(data);

            if(this.$route.params.idHero){

                this.$store.dispatch('hero/updateHero', data).then((response)=>{      
                    if(response)
                    {
                        alert('Hero telah diupdate')
                        parent.$router.push('/hero')
                    }
                })

            }
            else{
                this.$store.dispatch('hero/insertHero', data).then((response)=>{                
              
                    if(response)
                    {
                        alert('Hero baru telah ditambahkan')
                        parent.$router.push('/hero')
                    }
                                                                    
                })
            }
            
        }
       
    },
    data(){
        return{            
            imgUrl: null,
            imgName: 'Search Here',
            slider: 90,
            roleOption: [],
            specialityOption: [],
            idHero : null
        }
    }
}
</script>
