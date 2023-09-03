<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                    <div class="container px-5 mx-auto">
                        <div class="flex flex-col text-center w-full mb-12">
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">メンバー管理</p>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success text-green-400 mx-4 my-1">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-error text-red-400 mx-4 my-1">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="w-full mx-2">
                        <div class="report-list-area hidden sm:block">
                            <div class="overflow-hidden shadow-sm">
                                    <div class="w-full overflow-auto">
                                    <table class="table-auto w-full text-left">
                                        <tbody>
                                        @foreach($admins as $admin)
                                        <tr class="border border-blue border-2">
                                            <td class="w-1/3 px-8 py-8 text-lg font-bold text-gray-500">{{ $admin->name }}</td>
                                            <td class="w-1/3 px-4 py-8 text-lg font-bold">{{ $admin->email }}</td>
                                            <td class="w-1/5 mt-8 mb-5 hover:text-gray-500 flex mx-auto text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-lg"><a href="{{ route('admin.shuhos.evictAdmin',$admin->id) }}" class="flex justify-center w-full h-full">削除</a></td>
                                        </tr>
                                        @endforeach
                                        @foreach($users as $user)
                                        <tr class="border border-blue border-2">
                                            <td class="w-1/3 px-8 py-8 text-lg font-bold text-gray-500">{{ $user->name }}</td>
                                            <td class="w-1/5 px-4 py-8 text-lg font-bold">{{ $user->email }}</td>
                                            <td class="w-1/5 mt-8 mb-5 hover:text-gray-500 flex mx-auto text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-lg"><a href="{{ route('admin.shuhos.evictMember',$user->id) }}" class="flex justify-center w-full h-full">削除</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>            
                        <div class="report-list-area sm:hidden block">
                            <div class="overflow-hidden shadow-sm">
                                    <div class="w-full overflow-auto">
                                    <table class="table-auto w-full text-left">
                                        <tbody>
                                        @foreach($admins as $admin)
                                        <tr class="border border-blue border-2">
                                            <td class="w-1/3 px-1 py-4 text-xs font-bold text-gray-500">{{ $admin->name }}</td>
                                            <td class="w-1/2 px-0 py-4 text-xs font-bold">{{ $admin->email }}</td>
                                            <td class="w-1/6 hover:text-gray-500 text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-xs"><a href="{{ route('admin.shuhos.evictAdmin',$admin->id) }}" class="flex justify-center w-full h-full">削除</a></td>
                                        </tr>
                                        @endforeach
                                        @foreach($users as $user)
                                        <tr class="border border-blue border-2">
                                            <td class="w-1/3 px-1 py-4 text-xs font-bold text-gray-500">{{ $user->name }}</td>
                                            <td class="w-1/2 px-0 py-4 text-xs font-bold">{{ $user->email }}</td>
                                            <td class="w-1/6 hover:text-gray-500 text-white bg-gray-500 border-0 focus:outline-none hover:bg-gray-600 rounded text-xs"><a href="{{ route('admin.shuhos.evictMember',$user->id) }}" class="flex justify-center w-full h-full">削除</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <br>
                        <a href="{{ route('admin.shuhos.index') }}" class="hidden sm:block text-blue-500 pt-4 mt-4">キャンセル</a>
                        </div>
                    </div>
                    </section>                    
                </div>
            </div>
        </div>
    </div>
    <div class="index_footer sm:hidden flex bg-gray-100 w-full my-auto border border-gray-300">
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.index') }}"><img src="{{ asset('storage/images/普通の家のアイコン.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.group') }}"><img src="{{ asset('storage/images/人物アイコン　チーム.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.invite') }}"><img src="{{ asset('storage/images/人物シルエット　プラス.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('admin.shuhos.memberList') }}"><img src="{{ asset('storage/images/アドレス帳のアイコン素材2.png') }}" class="flex justify-center"></a></div>
    </div>
</x-app-layout>
