<?php

namespace App\Repositories;


use App\Mail\RegisterEmail;
use App\Model\Admin;
use App\Http\Controllers\AdminController;
use App\Jobs\RegisterMailJob;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class AdminRepository
{
    /**
     * @var Admin
     */
    private $admin;

    /**
     * AdminRepisotory constractor.
     *
     * @param Admin $admin
     */

    //  public function __construct(Admin $admin)
    //  {
    //      $this->admin = $admin;
    //  }
     /**
      *
      * @param string $firstName;
      * @param string $lastName;
      * @param string $email;
      * @param string $password;
      * @param string $phone;
      * @param string $deviceToken;
      * @param string|null $photoToStore
      * @param int $role
      *
      * @return Admin
      */

     public function index()
     {
        return Admin::orderBy('created_at','desc')->paginate(10);
     }

     public function adminsNumber()
     {
        return Admin::count();
     }

     public function findAdmin($firstName)
    {
        return Admin::where( "first_name","like","%",$firstName,"%")->orderBy('created_at','desc')->paginate(7);
    }
     public static function create($firstName, $lastName, $email, $password,$phone,$photoToStore)
     {
        $admin = new Admin();
        $admin->first_name = $firstName;
        $admin->last_name = $lastName;
        $admin->email = $email;
        $admin->password =bcrypt($password);
        $admin->phone = $phone;
        $admin->photo = $photoToStore;
        $data = [
            'email'=> $email,
            'password'=> $password
        ];
        Mail::to($email)->send(new RegisterEmail($data));
        $admin->save();
        return $admin;
     }

     public function update($firstName, $lastName, $email, $password, $phone, $photoToStore,$id)
     {
        $admin = Admin::findOrFail($id);
        $admin->first_name = $firstName;
        $admin->last_name = $lastName;
        $admin->email = $email;
        $admin->password =bcrypt($password);
        $admin->phone = $phone;
        $admin->photo = $photoToStore;
        $admin->save();
        return $admin;
     }

     public function destroy($id){
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return true;

     }

     public static function saveToken($deviceToken,$id)
     {
        $admin = Admin::findOrFail($id);
        $admin->device_token = $deviceToken ;
        $admin->save();
        return $admin;
     }

     public function changePasword($password,$id){
        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($password) ;
        $admin->save();
        return $admin;
    }

}



