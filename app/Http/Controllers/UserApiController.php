<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

use function PHPUnit\Framework\fileExists;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users, 'message' => 'User List']);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |max:20| min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:25',
            'phone' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);


            // $response['response'] = $validator->messages();          {{ etao use kora jay but validation postman e valo
            //                                                                 vabe dekhay na  }}
            // return response()->json($response);

        }

        $manager = new ImageManager(new Driver());
        if ($request->hasFile('image')) {
            $new_name = time() . '-' . now()->format('M-d-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/profile/' . $new_name));
            $new_image = 'profile/' . $new_name;
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'image' => $new_image,
                'created_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!',
                'data' => $user,
            ], 201);

            // return response()->json(['user' => $user, 'message' => 'User Created Successfully!']);{{ evabeo deya jay success message}}

        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'created_at' => now(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!',
                'data' => $user,
            ], 201);

            // return response()->json(['user' => $user, 'message' => 'User Created Successfully!']);{{ evabeo deya jay success message}}
        }
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'max:20| min:3',
            'phone' => 'digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);


            // $response['response'] = $validator->messages();          {{ etao use kora jay but validation postman e valo
            //                                                                 vabe dekhay na  }}
            // return response()->json($response);

        }


        $manager = new ImageManager(new Driver());

        $request->validate([
            'name' => 'max:20| min:3',
            'email' => 'email',
        ]);

        $user = User::where('id', $id)->first();
        if ($request->hasFile('image')) {


            if (file_exists($user->image) && $user->image != null) {
                unlink($user->image);
            }


            $new_name = time() . '-' . now()->format('M-d-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/profile/' . $new_name));
            $new_image = 'profile/' . $new_name;




            // {{         $user->name = $request->name ?? $user->name;
            //             $user->email = $request->email ?? $user->email;
            //             $user->phone = $request->phone ?? $user->phone;
            //             $user->gender = $request->gender ?? $user->gender;
            //             $user->hobby = ($request->hobby) ? implode(',', $request->hobby) : $user->hobby;
            //             $user->updated_at = now();
            //             $user->save();

            // evabe dekhale success er moddhe full data pawa jabe data er moddhe tacara data= true evabe dekhbe..

            // }}





            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => ($request->phone) ? $request->phone : null,
                'image' => $new_image,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'updated_at' => now(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully!',
                'data' => $user,
            ], 201);

        } else {
            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'updated_at' => now(),



            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully!',
                'data' => $user,
            ], 201);
        }
    }


    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        if (fileExists($user->image) && $user->image != null) {
            unlink($user->image);
        }

        User::find($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User Deleted successfully!',
        ], 201);
    }
}
