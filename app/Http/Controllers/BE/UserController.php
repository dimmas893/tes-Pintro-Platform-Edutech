<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Http\Requests\BE\InsertUserRequest;
use App\Http\Requests\BE\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    // set index page view
    public function index()
    {
        return view('be.user.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = User::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>phone</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->phone->phone . '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function address()
    {
        return view('be.user.address');
    }

    // handle fetch all eamployees ajax request
    public function addressAll()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = User::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>';
            foreach ($emps  as $nomor => $emp) {
                $output .= '<tr>
        <td>' . ($nomor + 1) . '</td>
        <td>' . $emp->name . '</td>
        <td>' . $emp->email . '</td>';
                $output .= ' <td>';
                foreach ($emp->address as $index => $p) {
                    $output .= ($index + 1) . '. ' . $p->name . '<br>'; // Tambahkan koma atau karakter pemisah yang sesuai, dan <br> untuk membuat baris baru
                }
                $output .= '</td>
      </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function manytomany()
    {
        $role = Role::all();
        return view('be.user.manytomany', compact('role'));
    }

    // handle fetch all eamployees ajax request
    public function manytomanyAll(Request $request)
    {
        $id = $request->id;
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        if ($id) {
            $emps = User::whereHas('roles', function (Builder $query) use ($id) {
                $query->where('role_id', $id);
            })->get();
        } else {
            $emps = User::all();
        };
        // dd($emps);
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($emps  as $nomor => $emp) {
                $output .= '<tr>
                <td>' . ($nomor + 1) . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>';
                $output .= ' <td>';
                foreach ($emp->roles()->get() as $index => $p) {
                    $output .= ($index + 1) . '. ' . $p->name . '<br>'; // Tambahkan koma atau karakter pemisah yang sesuai, dan <br> untuk membuat baris baru
                }
                $output .= '</td>
            </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    // handle insert a new Tu ajax request
    public function store(InsertUserRequest $insertUserRequest)
    {

        $data = $insertUserRequest->all();
        $message = $insertUserRequest->messages();
        $rules = $insertUserRequest->rules();
        // dd($rules);
        $firstRule = Arr::first($rules);
        $validator = Validator::make($data, $firstRule, $message);

        if ($validator->passes()) {
            $empData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'password_asli' => $data['password']
            ];
            User::create($empData);
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        } else {
            // dd('else');
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = User::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(InsertUserRequest $insertUserRequest, UpdateUserRequest $updateUserRequest)
    {
        // dd($updateUserRequest);

        $requestUpdate = $updateUserRequest->all();
        $messageUpdate = $updateUserRequest->messages();
        $rulesUpdate = Arr::first($updateUserRequest->rules());

        $requestInsert = $insertUserRequest->all();
        $messageInsert = $insertUserRequest->messages();
        $rulesInsert = Arr::first($insertUserRequest->rules());


        $emp = User::find($requestUpdate['id']);
        if ($requestUpdate['email'] != $emp->email) {
            $validator = Validator::make($requestInsert, $rulesInsert, $messageInsert);
        } else {
            $validator = Validator::make($requestUpdate, $rulesUpdate, $messageUpdate);
        }
        if ($validator->passes()) {
            $empData = [
                'name' => $requestUpdate['name'],
                'email' => $requestUpdate['email'],
                'password' => Hash::make($requestUpdate['password']),
                'password_asli' => $requestUpdate['password']
            ];
            // dd($request->all());
            $emp->update($empData);
            return response()->json(['success' => 'Data berhasil di ubah']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = User::find($id);
        User::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
