<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);

        if ($request->search) {
            $users = User::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $users->appends(['search' => $request->search]);
        }

        $data = [
            'users' => $users
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $regions = Region::all();
        
        $data = [
            'roles' => $roles,
            'regions' => $regions,
        ];

        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $create = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'username' => $request->username,
                'region_id' => $request->region_id,
            ]);

            foreach ($request->roles as $role_id) {
                $role = Role::find($role_id)->name;
                $create->assignRole($role);
            }
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Thêm tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm tài khoản thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        
        $data = [
            'user' => $user,
            'roles' => $roles
        ];

        return view('user.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $regions = Region::all();
        
        $data = [
            'data_edit' => $user,
            'roles' => $roles,
            'regions' => $regions,
        ];

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'region_id' => $request->region_id,
            ]);
        
            $user->roles()->detach();

            foreach ($request->roles as $role_id) {
                $role = Role::find($role_id)->name;
                $user->assignRole($role);
            }
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Sửa tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa tài khoản thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->roles()->detach();
            $user->destroy($user->id);
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Xóa tài khoản thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa tài khoản thất bại!');
        }
    }

    public function viewChangePassword(User $user) 
    {
        $data = [
            'user' => $user,
        ];

        return view('user.change-password', $data);
    }

    public function changePassword(ChangePasswordRequest $request, User $user) 
    {
        try {
            DB::beginTransaction();
            
            if (Hash::check($request->password_old, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            
            DB::commit();
            return redirect()->back()->with('alert-success','Đổi mật khẩu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Đổi mật khẩu thất bại!');
        }
    }
}
