<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user', 'banner', 'logo', 'name', 'sub_name', 'tax_code', 'sologan', 'size', 'jobs', 'city', 'district', 'town', 'address', 'description', 'images', 'branchs', 'lat', 'lng', 'youtube_link', 'template'];

    public function getPhoneNumber($user_id){
        $user = User::findOrFail($user_id);
        if($user)
            return $user->phone;
        return '';
    }
}
