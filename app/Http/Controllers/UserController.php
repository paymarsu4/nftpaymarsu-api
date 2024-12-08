<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentOrg;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('users.*', 'colleges.college_name', 'student_orgs.org_name', 'student_orgs.org_acronym')
            ->leftJoin('colleges', 'colleges.id', 'users.college_id')
            ->leftJoin('student_orgs', 'student_orgs.college_id', 'colleges.id')
            ->where('users.user_type',2)
            ->get();
        return $users;
        // return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'college_id' => ['required'],
            'org_name' => ['required'],
            'org_acronym' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ], [
            'college_id.required' => 'The college field is required.',
            'org_name.required' => 'The student org. name field is required.',
        ]);

        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            // 'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make($request->password),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'college_id' => $request->college_id,
            'user_type' => 2
        ]);

        $user->sendEmailVerificationNotification();

        if ($user->id) {
            $user = StudentOrg::create([
                'user_id' => $user->id,
                'college_id' => $user->college_id,
                'org_name' => $request->org_name,
                'org_acronym' => $request->org_acronym,
            ]);
        }

        event(new Registered($user));

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::select('users.*', 'colleges.college_name', 'student_orgs.org_name', 'student_orgs.org_acronym')
            ->leftJoin('colleges', 'colleges.id', 'users.college_id')
            ->leftJoin('student_orgs', 'student_orgs.college_id', 'colleges.id')
            ->where('users.id',$id)
            ->first();
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user_curr = User::find($request->user_id);

        $rule_email = "";
        if ($user_curr->email!=$request->email) {
            $rule_email = 'unique:'.User::class;
        }
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'college_id' => ['required'],
            'org_name' => ['required'],
            'org_acronym' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', $rule_email],
        ], [
            'college_id.required' => 'The college field is required.',
            'org_name.required' => 'The student org. name field is required.',
        ]);


        $user = User::find($request->user_id)->update([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'college_id' => $request->college_id
        ]);

        if ($request->password!="" || $user_curr->email!=$request->email) {
            event(new Registered($user));
        }

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function students($college_id)
    {
        $users = User::select('users.*', 'colleges.college_name', 'student_orgs.org_name', 'student_orgs.org_acronym')
            ->with(['paid_nfts' => function ($paid_nfts){
                $paid_nfts->select('paid_nfts.user_id', 'paid_nfts.token_id');
            }])
            ->leftJoin('colleges', 'colleges.id', 'users.college_id')
            ->leftJoin('student_orgs', 'student_orgs.college_id', 'colleges.id')
            ->where('users.user_type',3)
            ->where('users.college_id',$college_id)
            ->get();
        return $users;
    }
}
