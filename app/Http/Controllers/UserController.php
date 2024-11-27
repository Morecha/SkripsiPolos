<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\File\File;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('kepala-sekolah-or-superadmin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'NIP' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        $logika = User::where('email', $input['email'])->first();
        if($logika != null){
            return redirect()->back()->with('error', 'user dengan email ini sudah ada');
        }

        if($request->file('image')){
            $destinationPath = 'gambar/profil';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $image = $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }

        User::create($input);
        return redirect()->route('users.list')->with('success', 'user baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id,$request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'NIP' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
        ]);

        $user = User::find($id);
        $input = $request->all();

        if($request['password'] != null){
            $request->validate([
                'password' => 'required|min:6',
            ]);
        }else{
            unset($input['password']);
        }

        $logika = User::where('email', $input['email'])->first();
        if($logika != null){
            if($user->email != $logika['email']){
                return redirect()->back()->with('error', 'user dengan email ini sudah ada');
            }
        }

        if($request->file('image')){
            $request->validate([
                'image' => 'image|mimes:png,jpg,jpeg|max:10240',
            ]);

            $destinationPath = 'gambar/profil';
            $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();

            if($user->image != null){
                $oldImage = $user->image;
                if(file_exists(public_path('storage/'.$destinationPath.'/'.$oldImage))){
                    unlink(public_path('storage/'.$destinationPath.'/'.$oldImage));
                }
            }

            $request->file('image')->storeAs($destinationPath, $profileImage, 'public');
            $input['image'] = "$profileImage";
        }else {
            unset($input['image']);
        }

        $user->update($input);
        return redirect()->route('users.list')->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $image = $user->image;
        $destinationPath = 'gambar/profil/';

        if($image != null){
            if(file_exists(public_path('storage/'.$destinationPath.$image))){
                unlink(public_path('storage/'.$destinationPath.$image));
            }
        }
        $user->delete();
        return redirect()->route('users.list')->with('success', 'User berhasil dihapus');
    }
}
