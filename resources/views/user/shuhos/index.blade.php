<x-app-layout>
    <x-slot name="header">
    </x-slot>


    <div class="flex max-w-7xl mx-auto">
        <div class="w-1/4 mx-2">
        <div class="ml-2 text-lg font-semibold mb-1 mt-8">グループ</div>
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
    <div class="ml-2 text-lg font-semibold mb-1 mt-8">最近の更新</div>
        <div class="report-list-area sm:px-0 lg:px-0">
            <div class="overflow-hidden shadow-sm">
                    <div class="w-full overflow-auto">
                    <table class="table-auto w-full text-left">
                        <tbody>
                        @foreach($shuhos as $shuho)
                        <tr class="border border-blue border-2">
                            <td class="w-1/5 mx-100 pl-3 pr-0 pb-12 text-sm">{{ $shuho->name }}</td>
                            @php
                            if ($shuho->level == "good")
                            {
                                $strLevel = "順調";
                                $colorLevel = "text-blue-700";
                            }
                            if ($shuho->level == "normal")
                            {
                                $strLevel = "やや問題";
                                $colorLevel = "text-yellow-700";
                            }
                            if ($shuho->level == "bad")
                            {
                                $strLevel = "問題あり";
                                $colorLevel = "text-red-700";
                            }
                            @endphp
                            <td class="w-1/5 px-4 py-8 {{ $colorLevel }} text-lg">{{ $strLevel }}</td>
                            @php
                            if ($shuho->checked == false)
                            {
                                $strcheck = "未承認";
                                $colorcheck = "text-gray-500";
                            }
                            if ($shuho->checked == true)
                            {
                                $strcheck = "承認済";
                                $colorcheck = "text-green-600";
                            }
                            @endphp
                            <td class="w-1/5 px-4 py-8 {{ $colorcheck }} text-lg">{{ $strcheck }}</td>
                            <td class="w-2/5 mt-8 mb-5 hover:text-gray-500 flex mx-auto text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-lg"><a href="{{ route('user.shuhos.show',$shuho->id) }}" class="flex justify-center w-full h-full">詳細</a></td>
                            <td class="w-1/5 pt-11 pr-4 text-xs text-right">{{ $shuho->created_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- add start -->
                    {{ $shuhos->links() }}
                    <!-- add end -->
            </div>
        </div>
    </div>
</x-app-layout>
