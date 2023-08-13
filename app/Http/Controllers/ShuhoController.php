<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shuho;
use App\Http\Requests\StoreShuhoRequest;
use Illuminate\Support\Facades\Auth; // Authクラスを使うために追加
use App\Models\User;
use App\Models\UnitUser;
use App\Models\GroupUser;
use App\Models\Group;

class ShuhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth:users');
     }

    public function index()
    {
        $currentUser = Auth::guard('users')->user();
        if ($currentUser) {
                $currentUnitUser = UnitUser::Where('users_id', $currentUser->id)->first();

            // 管理者ユーザーがunit_usersテーブルに紐づいている場合は、unit_usersテーブルのidを取得
            if ($currentUnitUser) {
                $unitUserId = $currentUnitUser->id;
            }
        }
        // unit_usersテーブルのIDから現在所属しているグループのデータを取得
        $currentUserGroupDatas = GroupUser::where('user_id', $unitUserId)->get();
        $groupIds = $currentUserGroupDatas->pluck('group_id'); // group_idを配列として取得
        $currentGroupDatas = Group::whereIn('id', $groupIds)->get();



        $user_id = Auth::id();
        $shuhos = Shuho::whereHas('user', function ($query) use ($user_id) {
            $query->where('id', $user_id);
        })
        ->orderBy('id', 'desc') // ここでidカラムを降順にソート
        ->select('id', 'name', 'created_at', 'checked', 'level')
            ->paginate(9);

        return view('user.shuhos.index', ['shuhos' => $shuhos, 'groups'=> $currentGroupDatas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.shuhos.create');
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
        return to_route('user.shuhos.index');
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
        return view('user.shuhos.show', compact('shuho'));
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
        return view('user.shuhos.edit', compact('shuho'));
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
        return redirect()->route('user.shuhos.index');
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
        return redirect()->route('user.shuhos.index');
    }
}
