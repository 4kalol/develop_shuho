<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shuho;
use App\Http\Requests\StoreShuhoRequest;
use Illuminate\Support\Facades\Auth; // Authクラスを使うために追加
use App\Models\User;

class ShuhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $user_id = Auth::id();
        $shuhos = Shuho::whereHas('user', function ($query) use ($user_id) {
            $query->where('id', $user_id);
        })
        ->orderBy('id', 'desc') // ここでidカラムを降順にソート
        ->select('id', 'name', 'created_at', 'checked')
            ->paginate(5);

        return view('shuhos.index', ['shuhos' => $shuhos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shuhos.create');
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
        return to_route('shuhos.index');
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
        return view('shuhos.show', compact('shuho'));
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
        return view('shuhos.edit', compact('shuho'));
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
        return redirect()->route('shuhos.index');
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
        return redirect()->route('shuhos.index');
    }
}
