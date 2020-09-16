<?php

use Illuminate\Database\Seeder;

class UserCollectionSeeder extends Seeder
{   
    private $adminRepositories;

    /**
     * CategoriesCollectionSeeder constructor.
     * @param \App\Repositories\AdminRepositories $categoryRepository
     */
    public function __construct(\App\Repositories\AdminRepositories $adminRepositories)
    {
        $this->repo = $adminRepositories;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'username'  => 'admin', 
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('123456789'),            
        ];

        $this->repo->save($admin);
    }
}
