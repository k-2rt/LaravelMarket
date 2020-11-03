<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->middleware('auth:admin');
        $this->admin = $admin;
    }

    /**
     * Show admin user lists
     *
     * @return void
     */
    public function showUserRoleLists()
    {
        $users = $this->admin->where('type', '=', '2')->get();

        return  view('admin.role.user_lists', compact('users'));
    }

    /**
     * Show edit admin user page
     *
     * @param String $id
     * @return void
     */
    public function editAdminUser($id)
    {
        $user = $this->admin->find($id);

        return  view('admin.role.edit_role', compact('user'));
    }

    /**
     * Delete admin user
     *
     * @param String $id
     * @return void
     */
    public function deleteAdminUser($id)
    {
        $this->admin->find($id)->delete();

        $notification = array(
            'message' => 'ユーザーを削除しました',
            'alert-type' => 'success'
        );

        return  redirect()->back()->with($notification);
    }

    /**
     * Show create admin user page
     *
     * @return void
     */
    public function createAdminUser()
    {
        return  view('admin.role.create');
    }

    /**
     * Store new admin user
     *
     * @param Request $request
     * @return void
     */
    public function storeAdminUser(Request $request)
    {
        $this->admin->create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'category' => $request->category ?? "0",
            'coupon' => $request->coupon ?? "0",
            'product' => $request->product ?? "0",
            'article' => $request->article ?? "0",
            'order' => $request->order ?? "0",
            'other' => $request->other ?? "0",
            'report' => $request->report ?? "0",
            'return' => $request->return ?? "0",
            'role' => $request->role ?? "0",
            'contact' => $request->contact ?? "0",
            'comment' => $request->comment ?? "0",
            'setting' => $request->setting ?? "0",
            'stock' => $request->stock ?? "0",
            'type' => '2',
        ]);

        $notification = array(
            'message' => 'ユーザーを作成しました',
            'alert-type' => 'success'
        );

        return  redirect()->route('admin.user.lists')->with($notification);
    }

    /**
     * Update admin user
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateAdminUser(Request $request, $id)
    {
        $this->admin->find($id)->update([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'phone' => $request->phone,
            'category' => $request->category ?? "0",
            'coupon' => $request->coupon ?? "0",
            'product' => $request->product ?? "0",
            'article' => $request->article ?? "0",
            'order' => $request->order ?? "0",
            'other' => $request->other ?? "0",
            'report' => $request->report ?? "0",
            'return' => $request->return ?? "0",
            'role' => $request->role ?? "0",
            'contact' => $request->contact ?? "0",
            'comment' => $request->comment ?? "0",
            'setting' => $request->setting ?? "0",
            'stock' => $request->stock ?? "0",
        ]);

        $notification = array(
            'message' => 'ユーザーを更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user.lists')->with($notification);
    }
}
