import Dashboard from '../components/ExampleComponent.vue'
import Role from '../components/role/RoleListComponent.vue'
import Speciality from '../components/speciality/SpecialityListComponent.vue'
import Hero from '../components/hero/HeroListComponent.vue'
import AddHero from '../components/hero/HeroFormComponent.vue'
import Kriteria from '../components/kriteria/KriteriaListComponent.vue'
import Electre from '../components/electre/ElectreFormComponent.vue'
import ResultElectre from '../components/electre/ResultElectreComponent.vue'
import Login from '../components/LoginComponent.vue'
import UserListHero from '../components/hero/UserHeroListComponenet.vue'
    
export default [
  {
		path : '/admin/login',
		name : 'login',
        meta : { 
                 name : 'Login',                                   
                 title : 'Login Page',  
                 menuParent: '', 
                //  require_auth: false,                  
               },
    component : Login,
  
  },     
	{
		path : '/admin',
		name : 'admin.dashboard',
        meta : { 
                 name : 'Dashboard',                                   
                 title : 'Dashboard',  
                 menuParent: 'dashboard',
                 require_auth: true,                                    
               },
    component : Dashboard,
  
  },     
  {
		path : '/admin/role',
		name : 'admin.role',
        meta : { 
                 name : 'Role',                                   
                 title : 'Role',        
                 menuParent: 'role',
                 require_auth: true,                              
               },
    component : Role,  
  },    
  {
		path : '/admin/speciality',
		name : 'admin.speciality',
        meta : { 
                 name : 'Speciality',                                   
                 title : 'Speciality',    
                 menuParent: 'speciality',
                 require_auth: true,                    
               },
    component : Speciality,  
  },     
  
  {
		path : '/admin/hero',
		name : 'admin.hero',
        meta : { 
                 name : 'Hero',                                   
                 title : 'Hero',    
                 menuParent: 'hero',
                 require_auth: true,                  
               },
    component : Hero,  
  },   
  {
		path : '/admin/hero/add',
		name : 'admin.hero.add',
        meta : { 
                 name : 'Add New Hero',                                   
                 title : 'Add New Hero',    
                 menuParent: 'hero',
                 require_auth: true,                  
               },
    component : AddHero,  
  },   
  {
		path : '/admin/hero/edit/:idHero',
		name : 'admin.hero.edit',
        meta : { 
                 name : 'Edit Hero',                                   
                 title : 'Edit Hero',    
                 menuParent: 'hero',
                 require_auth: true,                  
               },
    component : AddHero,  
  },   
  {
		path : '/admin/kriteria',
		name : 'admin.kriteria',
        meta : { 
                 name : 'Kriteria',                                   
                 title : 'Kriteria',    
                 menuParent: 'kriteria',
                 require_auth: true,                  
               },
    component : Kriteria,  
  },   

  // TAMPILAN USER 

  {
		path : '/electre',
		name : 'admin.electre',
        meta : { 
                 name : 'Perhitungan Electre',                                   
                 title : 'Perhitungan Electre',    
                 menuParent: 'electre',
                //  require_auth: true,                  
               },
    component : Electre,  
  },   
  {
		path : '/electre/result',
		name : 'admin.electre.result',
        meta : { 
                 name : 'Hasil Perhitungan Electre',                                   
                 title : 'Hasil Perhitungan Electre',    
                 menuParent: 'electre',
                //  require_auth: true,                                                  
               },
    component : ResultElectre,  
  },   

  {
		path : '/hero',
		name : 'list.hero',
        meta : { 
                 name : 'Hero',                                   
                 title : 'Daftar Hero',    
                 menuParent: 'hero',
                //  require_auth: true,                                                  
               },
    component : UserListHero,  
  },   
  


];    
