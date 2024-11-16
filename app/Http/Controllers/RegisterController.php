<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(){
        return view('register');
    }


    public function signup(UserValidate $request){

        $manager = new ImageManager(new Driver());
        if ($request->hasFile('image')) {
            $new_name = time(). '-'. now()->format('M-d-Y'). '.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/profile/'.$new_name));
            $new_image = 'profile/'.$new_name;          //{just path soho upload kora jeno indexing er somoy just image    call korlei cole ashe}

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',',$request->hobby) : null,
                'image' => isset($new_image) ? $new_image : null,
                'created_at' => now(),
            ]);
            return redirect('/')->with('success','Register Successful!');
        }else{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',',$request->hobby) : null,
                'created_at' => now(),
            ]);
            return redirect('/')->with('success','Registered Successfully!');
        }

    }
}
