<?php
namespace App\Traits;


trait ImageTrait
{
    public function uploadimage($input,$folder){
        $imageName = time().rand(0, 10000).'.'.$input->extension();
        $input->move(public_path($folder), $imageName);
        return $folder.'/'.$imageName;
    }
}
