import Dashboard from '../components/admin/DashboardComponent.vue'
import AddRole from '../components/admin/role/RoleFormComponent.vue'

export default [
    {
		path : '/admin',
		name : 'admin.dashboard',
        meta : { 
                 name : 'DashboardAdmin',                                  
                 title : 'Dashboard Admin',                    
               },
        component : Dashboard,  
    },   
    {
		path : '/admin/role/add',
		name : 'admin-add-role',
        meta : { 
                 name : 'AddRole', 
                 title : 'Tambah Role Baru',                    
               },
        component : AddRole,  
    },   
]