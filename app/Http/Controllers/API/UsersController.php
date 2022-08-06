<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate   = request('paginate', 10);
        $term       = request('search', '');
        $sortOrder  = request('sortOrder', 'desc');
        $orderBy    = request('orderBy', 'created_at');

        $users = User::search($term)
            ->orderBy($orderBy, $sortOrder)
            ->paginate($paginate);

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'      => 'required|string|min:3|max:255',
            'location_id' => 'required|integer|exists:locations,id',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|min:6|max:255|confirmed',
            'status'    => 'required|string',
            'role'      => 'required|string|exists:roles,name'
        ]);

        $role = array_pop($attributes);

        $user = User::create($attributes);

        $user->assignRole($role);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $attributes = request()->validate([
            'name'        => 'required|string|min:3|max:255',
            'location_id' => 'required|integer|exists:locations,id',
            'email'       => ['required', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'    => 'sometimes|required|min:6|max:255|confirmed',
            'status'      => 'required|string',
            'role'        => 'required|string|exists:roles,name'
        ]);

        $role = array_pop($attributes);

        $user = User::find($user->id);
        $user->update($attributes);


        // $user->update($attributes);

        $user->roles()->detach();

        $user->assignRole($role);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
