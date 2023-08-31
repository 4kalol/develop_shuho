<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="flex max-w-7xl mx-auto">
        <div class="w-1/4 mx-2 hidden sm:block">
        <div class="ml-2 text-lg font-semibold mb-1 mt-8 text-gray-500">グループ</div>
        <!-- グループ一覧をここに配置 -->
        <!-- 例えば、以下のように -->
        <div class="group-list-area">
        <div class="p-4">
            @foreach($groups as $group)
            <li class="py-4 pl-2 mb-2 h-full border border-blue bg-white"><a href="#" class="font-bold text-gray-500">{{ $group->name }}</a></li>
            @endforeach
        </div>
        </div>
    </div>

    <div class="mx-2 w-full sm:w-3/4 mb-20 sm:mb-0">
    <div class="hidden sm:block ml-2 text-lg font-semibold mb-1 mt-8 text-gray-500">最近の更新</div>
    <div class="sm:hidden block my-4"></div>
        <div class="report-list-area sm:px-0 lg:px-0">
            <div class="overflow-hidden shadow-sm">
                    <div class="w-full overflow-auto">
                    <table class="table-auto w-full text-left">
                        <tbody>
                        @foreach($users as $user)
                        <tr class="border border-blue border-2">
                            <td class="hidden sm:inline-block w-1/5 mx-100 pl-3 pr-0 pb-16 text-sm font-bold text-gray-500">{{ $user->name }}</td>
                            <td class="sm:hidden inline-block w-1/4 mx-100 my-2 pl-3 pr-0 pb-0 text-sm font-bold text-gray-500">{{ $user->name }}</td>
                            @php
                            if ($user->level == "good")
                            {
                                $strLevel = "順調";
                                $colorLevel = "color-level-good";
                            }
                            if ($user->level == "normal")
                            {
                                $strLevel = "やや問題";
                                $colorLevel = "color-level-normal";
                            }
                            if ($user->level == "bad")
                            {
                                $strLevel = "問題あり";
                                $colorLevel = "color-level-bad";
                            }
                            @endphp
                            <td class="hidden sm:inline-block w-1/5 px-4 py-8 {{ $colorLevel }} text-lg font-bold">{{ $strLevel }}</td>
                            <td class="sm:hidden inline-block w-1/3 my-2 px-0 pl-4 {{ $colorLevel }} text-base font-bold">{{ $strLevel }}</td>
                            @php
                            if ($user->checked == false)
                            {
                                $strcheck = "未承認";
                                $colorcheck = "text-gray-500";
                                if (config('app.env') === 'local'){
                                    $imagecheck = "storage/images/空欄.png";
                                }
                                else {
                                    $imagecheck = "develop_shuho/storage/images/空欄.png";
                                }
                            }
                            if ($user->checked == true)
                            {
                                $strcheck = "承認済";
                                $colorcheck = "text-green-600";
                                if (config('app.env') === 'local'){
                                    $imagecheck = "storage/images/approved3.png";
                                }
                                else {
                                    $imagecheck = "develop_shuho/storage/images/approved3.png";
                                }
                            }
                            @endphp
                            <td class="hidden sm:inline-block w-1/5 px-4 py-8 {{ $colorcheck }} text-lg font-bold hover:text-blue-500"><a href="{{ route('admin.shuhos.checkSub',$user->id) }}">{{ $strcheck }}</a></td>
                            <td class="sm:hidden inline-block w-1/5 pl-0 pr-5 my-2 mb-0 mx-0"><div class="border border-gray-300 p-2 "><a href="{{ route('admin.shuhos.checkSub',$user->id) }}" class="flex justify-center w-8"><img src="{{ asset($imagecheck) }}"></a></div></td>

                            <td class="hidden sm:inline-block w-1/5 my-8 hover:text-gray-500 mx-auto text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-lg"><a href="{{ route('admin.shuhos.show',$user->id) }}" class="flex justify-center w-full h-full">詳細</a></td>
                            <td class="sm:hidden inline-block w-1/6 my-0 hover:text-gray-500 mx-auto text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-base"><a href="{{ route('admin.shuhos.show',$user->id) }}" class="flex justify-center w-full h-full">詳細</a></td>
                            

                            <td class="hidden sm:inline-block w-1/5 pt-16 pr-1 text-xs text-right font-bold text-gray-500">{{ $user->created_at }}</td>   
                            <td class="sm:hidden flex w-full pt-0 pr-0 text-xs text-right font-bold text-gray-500">{{ $user->created_at }}</td>   
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="hidden sm:block">
                    {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add start -->
    <div class="sm:hidden block my-10"></div>
    <div class="sm:hidden block index_footer inline-block bg-gray-100 border border-gray-300 w-full mb-10 p-1">
    <div class="mb-6">
        {{ $users->links() }}
    </div>
    </div>
    <!-- add end -->
    <div class="index_footer sm:hidden flex bg-gray-100 w-full my-auto border border-gray-300">
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.index') }}"><img src="{{ asset('storage/images/普通の家のアイコン.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.group') }}"><img src="{{ asset('storage/images/人物アイコン　チーム.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.invite') }}"><img src="{{ asset('storage/images/人物シルエット　プラス.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.memberList') }}"><img src="{{ asset('storage/images/アドレス帳のアイコン素材2.png') }}" class="flex justify-center"></a></div>
    </div>
</x-app-layout>
