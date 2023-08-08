<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shuho;
use App\Http\Requests\StoreShuhoRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Auth; // Authクラスを使うために追加
use App\Models\Admin;
use App\Models\User;
use App\Models\UnitUser;
use App\Models\GroupUser;

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
        dd('test');
        // 現在のユーザのunit_usersテーブルのidを取得
        $currentUnitUserId = $this->getCurrentAdminUnitUserId();

        // $currentUnitUserIdを使用してgroup_userテーブルより
        // ログインユーザのレコードを取得する
        $currentUserRecord = GroupUser::where('user_id', $currentUnitUserId)->first();
        if ($currentUserRecord) {
            $currentGroupId = $currentUserRecord->group_id;

            // $currentGroupIdと一致するgroup_userテーブルのuser_idを取得
            $userIds = GroupUser::where('group_id', $currentGroupId)->pluck('user_id')->toArray();

            // $userIdsとunit_usersテーブルのidが一致するusers_idを取得
            $unitUserIds = UnitUser::whereIn('id', $userIds)->pluck('users_id')->toArray();

            // $unitUserIdsとusersテーブルのidが一致するデータを取得
            $users = User::whereIn('id', $unitUserIds)->get();

            // $usersのidとshuhosテーブルのuser_idが一致するデータを取得
            $shuhos = Shuho::whereIn('user_id', $users->pluck('id'))
                    ->select('id', 'name', 'created_at', 'level', 'checked')->get()
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);
            
            // 暫定でViewファイルに渡す際の変数名を以前のものに治します
            $users = $shuhos;

            return view('admin.shuhos.index', ['users' => $users]);
        }
    }

    public function getCurrentAdminUnitUserId()
    {
        // 現在ログイン中の管理者ユーザー情報を取得
        $currentAdmin = Auth::guard('admins')->user();

        // 管理者ユーザーがunit_usersテーブルに紐づいている場合は、unit_usersテーブルのidを取得
        $unitUserId = null;
        if ($currentAdmin && $currentAdmin->unitUser) {
            $unitUserId = $currentAdmin->unitUser->id;
        }

        return $unitUserId;
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

    //コメントボタン押下時
    public function comment($id)
    {
        $shuho = Shuho::find($id);
        return view('admin.shuhos.comment', compact('shuho'));
    }

    //コメント入力ボタン押下時
    public function commentUpdate(UpdateCommentRequest $request, $id)
    {
        $shuho = Shuho::find($id);
        $shuho->comment = $request->comment;
        $shuho->save();

        return redirect()->route('admin.shuhos.show', compact('shuho'));
    }
}
