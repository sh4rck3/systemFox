<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return UserResource::collection(User::all());
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $users = User::
        when(request('search_id'), function ($query) {
            $query->where('id', request('search_id'));
        })
            //->where('status', '!=', '0')
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%'.request('search_title').'%');
                
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%'.request('search_global').'%')
                        ->orWhere('jobtitle', 'like', '%'.request('search_global').'%');

                });
            })
            ->where('status', '!=', '0')
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10);

            return UserResource::collection($users);
    }

    public function userslocal()
    {
        //return UserResource::collection(User::all());
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $users = User::
        when(request('search_id'), function ($query) {
            $query->where('id', request('search_id'));
        })
            //->where('status', '!=', '0')
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%'.request('search_title').'%');
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%'.request('search_global').'%')
                        ->orWhere('jobtitle', 'like', '%'.request('search_global').'%');

                });
            })
            ->where('status', '=', '0')
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10);

            return EmployeeResource::collection($users);
    }

    public function indexhome()
    {
        //return UserResource::collection(User::all());
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $users = Employee::
        when(request('search_id'), function ($query) {
            $query->where('id', request('search_id'));
        })
            //->where('status', '!=', '0')
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%'.request('search_title').'%');
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function($q) {
                    $q->where('id', request('search_global'))
                        ->orWhere('name', 'like', '%'.request('search_global').'%');

                });
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(5);

            return EmployeeResource::collection($users);
    }

    public function userssystem()
    {
        return UserResource::collection(User::all());
    }

    public function usersupdate()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://glpi.dunice.com.br/apirest.php/initSession',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic bHVjY2FzLnJpY2llcmk6UCNzc3cwcmQz',
            'App-Token: Bo3b3dDobZ9cgZZFWSr7o870i86BE0eRWSO9Vl5L',
            'Content-Type: aplicativo/json'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response, true);
        

        if($response['session_token']){
            $token = $response['session_token'];
        }else{
            //return response()->json(['status' => 405, 'success' => false]);  
            return response()->json([
                'status' => true,
                'title' => 'Token',
                'message' => 'Token não encontrado!'
            ], Response::HTTP_OK);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://glpi.dunice.com.br/apirest.php/searchTeste/user',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'App-Token: Bo3b3dDobZ9cgZZFWSr7o870i86BE0eRWSO9Vl5L',
            'Content-Type: aplicativo/json',
            'Session-Token:' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        $users = $response;

        foreach ($users as $key => $user) {
            if($this->usercheck($user) == false){
                $this->useradd($user);
            }else{
                $this->userupdate($user);
            }
        }

        return response()->json([
            'status' => true,
            'title' => 'Update',
            'message' => 'Employees updating success!'
        ], Response::HTTP_OK);
        

        
    }
    //firts step: check if user exists in local database
    public function usercheck($user)
    {
        $employee = User::where('email', $user['email'])->first();
        if($employee){
            return true;
        }else{
            return false;
        }
    }
    //if user not exists in local database, add user with permissions and roles
    public function useradd($user)
    {
        $valuesstr = array(".", "-");
        $hashpassword = str_replace($valuesstr, "", $user['foxcpffield']);

        if($user['email'] == 'luccas.ricieri@dunice.adv.br'){
            $role = 'admin';
        }else{
            $role = 'standard';
        }

            $useradd = new User();
            $useradd->email = $user['email'];
            $useradd->status = $user['is_active'];
            $useradd->extension = $user['phone'];
            $useradd->name = $user['firstname'] . '' . $user['realname'];
            $useradd->jobtitle = $user['name'];
            $useradd->sector = $user['completename'];
            $useradd->document = $user['foxcpffield'];
            $useradd->birthday = $user['foxdatadenascimentofield'];
            $useradd->password = Hash::make($hashpassword);
            $useradd->assignRole($role);
            $useradd->save();
    }
    //if user exists in local database, update user
    public function userupdate($user)
    {
        $userupdate = User::where('email', $user['email'])
                //->where('status', '=', '1')
                ->first();
        if($userupdate){
            $userupdate->email = $user['email'];
            $userupdate->status = $user['is_active'];
            $userupdate->extension = $user['phone'];
            $userupdate->name = $user['firstname'] . '' . $user['realname'];
            $userupdate->jobtitle = $user['name'];
            $userupdate->sector = $user['completename'];
            $userupdate->document = $user['foxcpffield'];
            $userupdate->birthday = $user['foxdatadenascimentofield'];
            $userupdate->save();
        }
    }

    public function employeeadd($user)
    {
            $employee = new Employee();
            $employee->birth_date = $user['begin_date'];
            $employee->email = $user['email'];
            $employee->status = $user['is_active'];
            $employee->extension = $user['phone'];
            $employee->name = $user['firstname'];
            $employee->lastname = $user['realname'];
            $employee->jobtitle = $user['name'];
            $employee->sector = $user['completename'];
            $employee->save();
    }

   

    public function employeecheck($user)
    {
        $employee = Employee::where('email', $user['email'])->first();
        if($employee){
            return true;
        }else{
            return false;
        }
    }

    

    public function employeeupdate($user)
    {
        $employee = Employee::where('email', $user['email'])
                ->where('status', '=', '1')
                ->first();
        if($employee){
            $employee->birth_date = $user['begin_date'];
            $employee->email = $user['email'];
            $employee->status = $user['is_active'];
            $employee->extension = $user['phone'];
            $employee->name = $user['firstname'];
            $employee->lastname = $user['realname'];
            $employee->jobtitle = $user['name'];
            $employee->sector = $user['completename'];
            $employee->save();
        }
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
