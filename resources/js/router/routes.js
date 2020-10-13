import Dashboard from '../components/ExampleComponent.vue'
import Role from '../components/role/RoleListComponent.vue'
import Speciality from '../components/speciality/SpecialityListComponent.vue'
import Hero from '../components/hero/HeroListComponent.vue'
import AddHero from '../components/hero/HeroFormComponent.vue'
    
export default [

	{
		path : '/',
		name : 'dashboard',
        meta : { 
                 name : 'Dashboard',                                   
                 title : 'Dashboard',  
                 menuParent: 'dashboard'                  
               },
    component : Dashboard,
  
  },     
  {
		path : '/role',
		name : 'admin.role',
        meta : { 
                 name : 'Role',                                   
                 title : 'Role',        
                 menuParent: 'role'            
               },
    component : Role,  
  },    
  {
		path : '/speciality',
		name : 'admin.speciality',
        meta : { 
                 name : 'Speciality',                                   
                 title : 'Speciality',    
                 menuParent: 'speciality'                
               },
    component : Speciality,  
  },     
  
  {
		path : '/hero',
		name : 'admin.hero',
        meta : { 
                 name : 'Hero',                                   
                 title : 'Hero',    
                 menuParent: 'hero'                                
               },
    component : Hero,  
  },   
  {
		path : '/hero/add',
		name : 'admin.hero.add',
        meta : { 
                 name : 'Add New Hero',                                   
                 title : 'Add New Hero',    
                 menuParent: 'hero'                                
               },
    component : AddHero,  
  },   
  {
		path : '/hero/edit/:idHero',
		name : 'admin.hero.edit',
        meta : { 
                 name : 'Edit Hero',                                   
                 title : 'Edit Hero',    
                 menuParent: 'hero'                                
               },
    component : AddHero,  
  },   

];    
