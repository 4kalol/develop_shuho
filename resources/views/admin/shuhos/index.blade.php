<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="flex max-w-7xl mx-auto">
        <div class="w-1/4 mx-2">
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

    <div class="w-3/4 mx-2">
    <div class="ml-2 text-lg font-semibold mb-1 mt-8 text-gray-500">最近の更新</div>
        <div class="report-list-area sm:px-0 lg:px-0">
            <div class="overflow-hidden shadow-sm">
                    <div class="w-full overflow-auto">
                    <table class="table-auto w-full text-left">
                        <tbody>
                        @foreach($users as $user)
                        <tr class="border border-blue border-2">
                            <td class="w-1/5 mx-100 pl-3 pr-0 pb-12 text-sm font-bold text-gray-500">{{ $user->name }}</td>
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
                            <td class="w-1/5 px-4 py-8 {{ $colorLevel }} text-lg font-bold">{{ $strLevel }}</td>
                            @php
                            if ($user->checked == false)
                            {
                                $strcheck = "未承認";
                                $colorcheck = "text-gray-500";
                            }
                            if ($user->checked == true)
                            {
                                $strcheck = "承認済";
                                $colorcheck = "text-green-600";
                            }
                            @endphp
                            <td class="w-1/5 px-4 py-8 {{ $colorcheck }} text-lg font-bold hover:text-blue-500"><a href="{{ route('admin.shuhos.checkSub',$user->id) }}">{{ $strcheck }}</a></td>
                            <td class="w-2/5 mt-8 mb-5 hover:text-gray-500 flex mx-auto text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-lg"><a href="{{ route('admin.shuhos.show',$user->id) }}" class="flex justify-center w-full h-full">詳細</a></td>
                            <td class="w-1/5 pt-11 pr-4 text-xs text-right font-bold text-gray-500">{{ $user->created_at }}</td>   
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- add start -->
                    {{ $users->links() }}
                    <!-- add end -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
