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

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <section class="text-gray-600 body-font relative">
                    <form method="post" action="{{ route('admin.shuhos.inviterun') }}" onsubmit="return confirm('再度メールアドレスに間違いがないことを確認してください。');">
                        @csrf
                    <div class="container px-5 mx-auto">
                        <div class="flex flex-col text-center w-full mb-12">
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">メンバー追加画面</p>
                        </div>
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        @if(session('success'))
                            <div class="alert alert-success text-green-400 mx-1 my-1">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-error text-red-400 mx-1 my-1">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="flex flex-wrap -m-2">

                            <!-- email(メンバーアドレス) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            </div>

                            <!-- name(招待先グループ名選択) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">招待先グループ</label><br>  
                                @php
                                $groupDatas = [];
                                foreach ($currentGroupDatas as $currentGroupData){
                                  if ($currentGroupData->name != ""){
                                    $groupDatas[] = $currentGroupData;
                                  }
                                } 
                                @endphp

                                @if (empty($groupDatas))
                                招待可能なグループがありません。
                                @else                             
                                  @foreach ($groupDatas as $groupData)
                                  <input type="radio" name="selected_group" value="{{ $groupData->id }}">{{ $groupData->name }}
                                  @endforeach
                                @endif
                            </div>
                            </div>

                            <!-- button(登録ボタン) -->
                            </div>
                            <div class="p-2 w-full">
                            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">追加</button>
                            </div>
                        </div>
                        </div>
                        <a href="{{ route('admin.shuhos.index') }}" class="hidden sm:block text-blue-500">キャンセル</a>
                    </div>
                    </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="index_footer sm:hidden flex bg-green-200 w-full my-auto">
        <div class="w-1/6 mx-auto my-2"><a href="{{ route('admin.shuhos.index') }}"><img src="{{ asset('storage/images/house-button.svg') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-2"><a href="{{ route('admin.shuhos.group') }}"><img src="{{ asset('storage/images/people-roof-solid.svg') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-2"><a href="{{ route('admin.shuhos.invite') }}"><img src="{{ asset('storage/images/user-plus-solid.svg') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-2"><a href="{{ route('admin.shuhos.memberList') }}"><img src="{{ asset('storage/images/users-solid.svg') }}" class="flex justify-center"></a></div>
    </div>
</x-app-layout>
