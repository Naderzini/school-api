<?php

namespace App\Repositories;

use App\Model\ChildParent;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;
class ChildParentRepository
{

     /**
      *
      * @param string $firstName;
      * @param string $lastName;
      * @param string $email;
      * @param string $password;
      * @param int    $cin
      * @param string $adress;
      * @param string|null $photoToStore
      * @param string $genre
      * @param string $occupation
      *
      * @return ChildParent
      */

    public function index(){
        return ChildParent::orderBy('created_at','desc')->paginate(10);
     }

    public static function create($cin,$firstName, $lastName, $email, $password, $genre, $photoToStore, $occupation, $postalCode ,$city,$government,$phone)
     {
        $parent = new ChildParent();
        $parent->cin = $cin;
        $parent->first_name = $firstName;
        $parent->last_name = $lastName;
        $parent->email = $email;
        $parent->password = bcrypt($password);
        $parent->genre = $genre;
        $parent->photo = $photoToStore;
        $parent->occupation = $occupation;
        $parent->city = $city;
        $parent->postal_code = $postalCode;
        $parent->government = $government;
        $parent->phone = $phone;
        $data = [
            'email'=> $email,
            'password'=> $password
        ];
        // Mail::send(new RegisterEmail($data))->to($email);
        $parent->save();
        return $parent;
     }

    public function update($cin,$firstName, $lastName, $email, $password, $genre, $photoToStore, $occupation, $postalCode ,$city,$government,$phone,$id)
     {
        $parent = ChildParent::findOrFail($id);
        $parent->cin = $cin;
        $parent->first_name = $firstName;
        $parent->last_name = $lastName;
        $parent->email = $email;
        $parent->password = bcrypt($password);
        $parent->genre = $genre;
        $parent->photo = $photoToStore;
        $parent->occupation = $occupation;
        $parent->city = $city;
        $parent->postal_code = $postalCode;
        $parent->government= $government;
        $parent->phone = $phone;
        $parent->save();
        return $parent;
     }

    public function destroy($id){
        $parent = ChildParent::findOrFail($id);
        $parent->delete();
        return true;

     }

    public static function saveTokenDevice($deviceToken,$id){
        $parent = ChildParent::findOrFail($id);
        $parent->device_token = $deviceToken ;
        $parent->save();
        return $parent;
     }

    public function changePasword($password,$id)
    {
        $parent = ChildParent::findOrFail($id);
        $parent->password = bcrypt($password) ;
        $parent->save();
        return $parent;
    }

    public function parentsNumber()
     {
        return ChildParent::count();
     }

     public function parentsMenNumber()
     {
       return ChildParent::where('genre', '=','homme')->count();
     }

     public function parentsWomenNumber()
    {
        return ChildParent::where('genre', '=','femme')->count();
    }
}
