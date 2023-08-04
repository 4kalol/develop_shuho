<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shuho;
use App\Http\Requests\StoreShuhoRequest;
use Illuminate\Support\Facades\Auth; // Authクラスを使うために追加
use App\Models\Admin;
use App\Models\User;

class AdminShuhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth:admins');
     }

    public function index()
    {
        $users = Shuho::select('id', 'name', 'created_at','level', 'checked')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.shuhos.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shuhos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShuhoRequest $request)
    {
        // dd($request);
        $user_num = Auth::id();
        $user = User::find($user_num);
        $user_id = $user->id;

        // $user = User::create([
        $user = Shuho::create([
            'user_id' => $user_id, // ログインしているユーザーのIDをuser_idカラムに保存
            'name' => $request->name,
            'level' => $request->level,
            'report' => $request->report,
            'checked' => false,
            'comment' => "",
        ]);

        // リダイレクト先(Store処理後に遷移する画面).
        return to_route('admin.shuhos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shuho = Shuho::find($id);
        return view('admin.shuhos.show', compact('shuho'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shuho = Shuho::find($id);
        return view('admin.shuhos.edit', compact('shuho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShuhoRequest $request, $id)
    {
        //dd($request);
        $shuho = Shuho::find($id);
        $shuho->name = $request->name;
        $shuho->level = $request->level;
        $shuho->report = $request->report;
        //$shuho->checked = $request->checked;
        //$shuho->comment = $request->comment;
        $shuho->save();

        // リダイレクト先(Store処理後に遷移する画面).
        return redirect()->route('admin.shuhos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $shuho = Shuho::find($id);
        $shuho->delete();

        // リダイレクト先(Store処理後に遷移する画面).
        return redirect()->route('admin.shuhos.index');
    }

    //詳細画面からの承認操作
    public function checkShuho($id)
    {
        $shuho = Shuho::find($id);
        if ($shuho->checked == 0) {
            $shuho->checked = 1;
        }
        elseif ($shuho->checked == 1) {
            $shuho->checked = 0;
        }
        $shuho->save();
        return redirect()->route('admin.shuhos.show', compact('shuho'));
    }

    //メイン画面からの簡易承認操作
    public function checkShuhoSub($id)
    {
        $shuho = Shuho::find($id);
        if ($shuho->checked == 0) {
            $shuho->checked = 1;
        }
        elseif ($shuho->checked == 1) {
            $shuho->checked = 0;
        }
        $shuho->save();
        return redirect()->route('admin.shuhos.index', compact('shuho'));
    }
}
