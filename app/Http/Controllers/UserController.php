<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Mail\OtpSend;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\fileExists;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $users = User::paginate(10);
        $search = $request->search;
        if ($search) {
            $users = User::where('name', 'Like', '%' . $search . '%')
                ->orWhere('email', 'Like', '%' . $search . '%')
                ->orWhere('phone', 'Like', '%' . $search . '%')
                ->orWhere('gender', 'Like', '%' . $search . '%')
                ->paginate(5);
        }

        return view('list', compact('users', 'search'));
    }





    public function create()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        return view('create');
    }


    public function store(UserValidate $request)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $manager = new ImageManager(new Driver());
        if ($request->hasFile('image')) {
            $new_name = time() . '-' . now()->format('M-d-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/profile/' . $new_name));
            $new_image = 'profile/' . $new_name;
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'image' => $new_image,
                'created_at' => now(),
            ]);
            return redirect('user/list')->with('success', 'User Created Successfully!');
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'created_at' => now(),
            ]);
            return redirect('user/list')->with('success', 'User Created Successfully!');
        }
    }


    public function edit($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find($id);
        return view('edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $manager = new ImageManager(new Driver());
        if (!Auth::user()) {
            return redirect('/');
        }
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

            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => ($request->phone) ? $request->phone : null,
                'image' => $new_image,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'updated_at' => now(),
            ]);
            return redirect('user/list')->with('success', 'User Updated Successfully!');
        } else {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'hobby' => ($request->hobby) ? implode(',', $request->hobby) : null,
                'updated_at' => now(),
            ]);
            return redirect('user/list')->with('success', 'User Updated Successfully!');
        }
    }

    public function delete($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::where('id', $id)->first();
        if (fileExists($user->image) && $user->image != null) {
            unlink($user->image);
        }

        User::find($id)->delete();
        return redirect('user/list');
    }


    public function show($id)
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $show = User::where('id', $id)->first();
        dd($show->toArray());
    }


}
