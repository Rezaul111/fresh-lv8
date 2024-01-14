<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\This;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission($permission){
        if(!empty($permission)){
            foreach ($permission->roles as $role){
                if($this->roles->contains($role)) {
                    return true;
                }
            }
        }
        return false;

    }
    public function hasAnyRole($role){
        return $this->roles()->where('slug',$role)->first()??'';
    }
    public function hasRoles($roles){
        return $this->roles()->whereIn('slug',$roles)->first()??'';
    }
    public static function checkValidation($request){
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required|unique:users,email',
            'password'  =>  'required|confirmed|min:6',
            'role_id'   =>  'required|array',
            'role_id.*' =>  'required|integer',

//            'mobile'    =>  'required|regex:/(01)[0-9]{9}/|max:11|unique:users,mobile',
            'image'     =>  'image|mimes:jpeg,jpg,webp',
        ]);
    }
    public static function updateValidation($request,$user){
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required|unique:users,email, '.$user->id,
            'password'  =>  'required|confirmed|min:6',
            'role_id'   =>  'required|array',
            'role_id.*' =>  'required|integer',
//            'mobile'    =>  'required|regex:/(01)[0-9]{9}/|max:11|unique:users,mobile',
            'image'     =>  'image|mimes:jpeg,jpg,webp',
        ]);
    }
    public static function imageUpload($request){
        if($request->hasFile('image')){
            $image      =   $request->file('image');
            $imageName  =   time().'.'.$image->getClientOriginalExtension();
            $directory  =   './admin/user_images/';
            $imageUrl   =   $directory.$imageName;
            Image::make($image)->resize(160,135)->save($imageUrl,65);
            return $imageUrl;
        }
    }
    public static function insertUserInfo($request){
     return   User::create([
            'name'      =>  $request->name??'',
            'email'     =>  $request->email??'',
            'password'  =>  Hash::make($request->password)??'',
            'mobile'    =>  $request->mobile??'',
            'image'     =>  self::imageUpload($request),
        ])->roles()->sync($request->input('role_id'));
    }

    public static function updateUserInfo($request,$user){
        $image  =   $request->hasFile('image');
        if($image){
            if(file_exists($user->image)){
                unlink($user->image);
                $imageUrl       =  Self::imageUpload($request);
            }else{
                $imageUrl       =  self::imageUpload($request);
            }
        }
        else{
            $imageUrl       =  $user->image;
        }

      $data=  $user->update([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'mobile'    =>  $request->mobile,
            'image'     =>  $imageUrl,
            'status'    =>  $request->status,
        ]);
        $user->roles()->sync($request->input('role_id'));
        return $data ;
    }

}


