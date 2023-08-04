<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Spinach') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">状況</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">承認</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->created_at }}</td>
                            @php
                            $level = $user->level;
                            $strLevel = ''; // 初期化
                            if ($level == 'good'){
                                $strLevel = '順調';
                            }
                            if ($level == 'normal'){
                                $strLevel = 'やや問題';
                            }
                            if ($level == 'bad'){
                              $strLevel = '問題あり';
                            }
                            @endphp
                            <td class="px-4 py-3">{{ $strLevel }}</td>
                            @php
                            if ($user->checked == false)
                            {
                                $strcheck = "未";
                                $colorcheck = "text-red-400";
                            }
                            if ($user->checked == true)
                            {
                                $strcheck = "済";
                                $colorcheck = "text-green-400";
                            }
                            @endphp
                            <td class="px-4 py-3 {{ $colorcheck }} hover:text-blue-500"><a href="{{ route('admin.shuhos.checkSub',$user->id) }}">{{ $strcheck }}</a></td>
                            <td class="px-4 py-3 hover:text-blue-500"><a href="{{ route('admin.shuhos.show',$user->id) }}">詳細を見る</a></td>
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
