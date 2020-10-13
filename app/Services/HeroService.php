<?php

namespace App\Services;

use App\Repositories\HeroRepository;
use App\Utils\DateHelper;

class HeroService
{
    private $repo;

    public function __construct(HeroRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {          
        $heros = $this->repo->getAll();
        
        foreach($heros as &$hero )
        {
            $role = (array) $hero['role'];
            $speciality = (array) $hero['speciality'];
            $hero['role'] = implode(', ', $role);
            $hero['speciality'] = implode(', ', $speciality);
        }
        
        return $heros;
    }

    public function getOne($idHero)
    {
        $filter = ['_id' => $idHero ];
        $hero =  $this->repo->getOne($filter);
             
        return $hero;
    }

    public function insert($att)
    {
        if($att['photo']->isValid())
        {
            $image = $att['photo'];
            $fileName = date('YmdHis').$image->getClientOriginalName();
            $path = 'image/'.$fileName;
            $image->move('image', $fileName);
            $att['photo'] = $path;
        }
        
        $insert = $this->repo->save($att);
        return $insert;
    }

    public function update($att)
    {        

        if( is_object($att['photo']) )
        {
            $image = $att['photo'];
            $fileName = date('YmdHis').$image->getClientOriginalName();
            $path = 'image/'.$fileName;
            $image->move('image', $fileName);
            $att['photo'] = $path;

            unlink(public_path($att['old_photo']));
            unset($att['old_photo']);
        }
        $update = $this->repo->save($att);

        return $update;
    }

    public function delete($idHero)
    {
        $hero = $this->getOne($idHero);
        print_r($hero);
        unlink(public_path($hero['photo']));

        $delete = $this->repo->delete($idHero);
        
        return 'Hero berhasil dihapus';
    }
  

}
