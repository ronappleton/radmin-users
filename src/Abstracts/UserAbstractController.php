<?php

namespace RonAppleton\Radmin\Users\Abstracts;
use Illuminate\Http\Request;
use RonAppleton\Radmin\Users\Contracts\UserControllerInterface;
use RonAppleton\Radmin\Users\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserAbstractController extends Controller implements UserControllerInterface
{
    private $userModelClass;

    public function handle($method)
    {
        if(empty($this->$method()))
        {
            throw new NotFoundHttpException;
        }
        return $this->$method();
    }

    public function __construct()
    {
        $this->userModelClass = config('radmin-users.user_model');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radmin-users::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('radmin-users::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = getUserTableName();

        $this->validate($request, [
            'name' => 'required:string',
            'email' => "required|unique:{$table},email",
        ]);

        $this->userModelClass::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(str_random(12))
        ]);

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->load($id);

        return view('radmin-users::show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->load($id);

        return view('radmin-users::edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table = getUserTableName();

        $this->validate($request, [
            'name' => 'required:string',
            'email' => "required|unique:{$table},email",
        ]);

        $this->load($request->id)->fill($request->toArray())->save();

        return view('radmin-users::index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->load($id)->delete();

        return view('radmin-users::index');
    }

    public function load($id)
    {
        $model = $this->userModelClass;
        return $model::where('id',$id)->first();
    }
}