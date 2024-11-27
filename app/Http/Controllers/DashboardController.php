<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        return view('admin.profile.settings');
    }

    public function updateGeneral(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required',
            'alamat' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);


        $user = User::find(Auth::user()->id);
        // dd($user->id);
        $input = $request->all();

        $logika = User::where('email', $input['email'])
                ->where('id', '!=', $user->id)
                ->first();

        if($logika != null){
            // dd('sudah ada');
            return redirect()->back()->with('error', 'Email sudah terdaftar');
        }

        if($request->file('image')) {

            $destinationPath = 'gambar/profil';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();

            if($user->image != null){
                $oldImage = $user->image;
                if(file_exists(public_path('storage/'.$destinationPath.'/'.$oldImage))){
                    File::delete(public_path('storage/'.$destinationPath.'/'.$oldImage));
                }
            }

            $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }else {
            unset($input['image']);
        }

        $user->update($input);
        return redirect()->back()->with('success', 'Profile berhasil diubah');
    }

    public function updatePassword(Request $request, $id)
    {
        // dd($request);

        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|min:6',
        ]);

        if(!Hash::check($request->password, Auth::user()->password)){
            return redirect()->back()->with('error', 'Old Password doesnt match');
        }

        if($request->new_password != $request->confirm_new_password){
            return redirect()->back()->with('error', 'the new password field doesnt match with the confirm new password field');
        }

        dd('berhasil');
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
            ]);

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}

