<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('週報まとめる君') }}
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
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">承認</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shuhos as $shuho)
                        <tr>
                            <td class="px-4 py-3">{{ $shuho->id }}</td>
                            <td class="px-4 py-3">{{ $shuho->name }}</td>
                            <td class="px-4 py-3">{{ $shuho->created_at }}</td>
                            @php
                            if ($shuho->checked == false)
                            {
                                $strcheck = "未";
                            }
                            if ($shuho->checked == true)
                            {
                                $strcheck = "済";
                            }
                            @endphp
                            <td class="px-4 py-3">{{ $strcheck }}</td>
                            <td class="px-4 py-3 text-blue-500"><a href="{{ route('shuhos.show',$shuho->id) }}">詳細を見る</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
