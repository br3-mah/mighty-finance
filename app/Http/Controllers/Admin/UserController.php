<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\EmailTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Mail\BTFAccount;
use App\Models\Wallet;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    use EmailTrait;
    // public function __construct()
    // {
    //     $this->middleware('can:admin.users.index')->only('index');
    //     $this->middleware('can:admin.users.edit')->only('edit', 'update');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function store(User $user, Request $request) 
    {
        DB::beginTransaction();
        try {     
            if ($request->file('image_path')) {
                $url = Storage::put('public/users', $request->file('image_path'));
            }
            
            $u = $user->create(array_merge($request->all(), [
                'password' => bcrypt('20230101bridge.@2you'),
                'active' => 1,
                'profile_photo_path' => $url ?? ''
            ]));
            
            $u->syncRoles($request->assigned_role);

            // Onyl users with Emails
            if($u->email != null){ 
                $mail = [
                    'name' => $u->fname.' '.$u->lname,
                    'to' => $u->email,
                    'from' => 'admin@bridgetrustfinance.co.zm',
                    'phone' => $u->phone,
                    'subject' => 'Your Brigetrust Finance Account',
                    'message' => 'Hello '.$u->fname.' '.$u->lname.' Your Bridgetrust Finance account is now ready, Click on login to goto your dashboard. Your password is 20230101bridge.@2you  -  feel free to change your password.',
                ];
            }
            
            try {
                // Send Email to User with Email only about their New Account Created
                if($u->email != null){
                    $eMail = new BTFAccount($mail);
                    Mail::to($u->email)->send($eMail);
                }
                if($request->assigned_role == 'user'){
                    $url = '/apply-for-a-loan/ '.$u->id;
                    Wallet::create([
                        'user_id' => $u->id
                    ]);
                    // $link = new HtmlString('<a target="_blank" href="' . $url . '">Create a loan for '.$u->fname.' '.$u->lname.'</a>');
                    $msg = '<a target="_blank" href="'.$url.'">Apply for Loan on Behalf</a>';
                    Session::flash('success', "Borrower created successfully. ");
                    Session::flash('borrower_id', $u->id);
                }else{
                    Session::flash('success', "User created successfully.");
                }

                DB::commit();
                return back();
            } catch (\Throwable $th) {
                Session::flash('error', "Failed. Check your internet connection and try again.");
                DB::rollback();
                return back();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            if($request->assigned_role == 'user'){
                Session::flash('error', 'Oops.. There is a borrower account already using this email.');
            }elseif($request->assigned_role == 'employee'){
                Session::flash('error', 'Oops. There is an employee account already with this email.');
            }else{
                Session::flash('error', 'Oops.. An with this email already exists. please try again.');
            }
            return back();
        }

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
        return view ('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request) 
    {
        DB::beginTransaction();
        try {
            // Role::firstOrCreate(['name' => 'employee']);
            //For demo purposes only. When creating user or inviting a user
            // you should create a generated random password and email it to the user        
            if ($request->file('image_path')) {
                $url = Storage::put('public/users', $request->file('image_path'));
            }
            
            $user = User::find($request->user_edit_id);
            // dd($user);
            // $user->update(array_merge($request->all(), [
            //     'profile_photo_path' => $url ?? ''
            // ]));
            $data = array_merge($user->toArray(), $request->all(),[
                'profile_photo_path' => $url ?? ''
            ]);

            $user->fill($data);
            $user->save();
            $user->syncRoles($request->assigned_role);


            if($request->assigned_role == 'user'){
                $url = '/apply-for-a-loan/ '.$user->id;
                // $link = new HtmlString('<a target="_blank" href="' . $url . '">Create a loan for '.$u->fname.' '.$u->lname.'</a>');
                $msg = '<a target="_blank" href="'.$url.'">Apply for Loan on Behalf</a>';
                Session::flash('attention', "Borrower Updated successfully. ");
                Session::flash('borrower_id', $user->id);
            }else{
                Session::flash('attention', "User Updated successfully.");
            }
            DB::commit();
            return back();
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollback();
            
            if($request->assigned_role == 'user'){
                Session::flash('error_msg', 'Oops.. There is a borrower account already using this email.');
            }elseif($request->assigned_role == 'employee'){
                Session::flash('error_msg', 'Oops. There is an employee account already with this email.');
            }else{
                Session::flash('error_msg', 'Oops.. An with this email already exists. please try again.');
            }
            return back();
        }

    }


    public function share_doc(Request $request){
        $email = $request->toArray()['email'];
        $res = $this->send_pre_approval_forms($email);
        if($res){
            return response()->json(['msg' => 'success']);
        }else{
            return response()->json(['msg' => 'error']);
        }
    }
}
