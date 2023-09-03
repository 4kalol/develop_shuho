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
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">報告詳細</p>
                        </div>
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <div class="flex flex-wrap -m-2">

                          <!-- created_at(登録日) -->
                          <div class="p-2 w-full">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">登録日</label>
                                <p id="name" name="name" class="w-full bg-white-100 bg-opacity-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shuho->created_at }}</p>
                            </div>
                            </div>

                          <!-- Name(報告者名) -->
                          <div class="p-2 w-full">
                          <div class="relative">
                              <label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
                              <p id="name" name="name" class="w-full bg-white-100 bg-opacity-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shuho->name }}</p>
                          </div>
                          </div>

                          <!-- Level(順調度合) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                @php
                                $level = $shuho->level;
                                if ($level == 'good'){
                                  $strLevel = '順調';
                                }
                                if ($level == 'normal'){
                                  $strLevel = 'やや問題あり';
                                }
                                if ($level == 'bad'){
                                  $strLevel = '問題あり';
                                }
                                @endphp
                                <label for="level" class="leading-7 text-sm text-gray-600">順調度合い</label><br>
                                @php
                                if (empty($strLevel) == true){
                                  $strLevel = '入力なし';
                                }
                                @endphp
                                <p id="level" name="level" class="w-full bg-white-100 bg-opacity-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $strLevel }}</p>
                            </div>
                            </div>

                            <!-- Report(報告内容) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                <label for="report" class="leading-7 text-sm text-gray-600">報告内容</label>
                                <p id="report" name="report" class="w-full bg-white-100 bg-opacity-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shuho->report }}</p>
                            </div>
                            </div>
                            
                            <!-- checked(承認) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                @php
                                $check = $shuho->checked;
                                if ($check == 0){
                                  $strCheck = '承認待ち';
                                }
                                if ($check == 1){
                                  $strCheck = '承認済み';
                                }
                                @endphp
                                <label for="checked" class="leading-7 text-sm text-gray-600">承認</label>
                                <p id="checked" name="checked" class="w-full bg-white-100 bg-opacity-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $strCheck }}</p>
                            </div>
                            </div>

                            <!-- comment(上長コメント) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                              <label for="comment" class="leading-7 text-sm text-gray-600">確認コメント</label>
                              <p id="comment" name="comment" class="w-full bg-white-100 bg-opacity-50 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shuho->comment }}</p>
                            </div>
                            </div>

                            <!-- button(承認ボタン) -->
                            <!-- button(コメントボタン) -->
                            </div>
                            <div class="p-2">
                              @php
                              $check = $shuho->checked;
                              if ($check == 0){
                                $buttonCheck = '承認';
                              }
                              if ($check == 1){
                                $buttonCheck = '承認取り消し';
                              }
                              @endphp
                            <a href="{{ route('admin.shuhos.check',$shuho->id) }}" class="hidden w-1/4 sm:flex mx-auto my-1 text-white bg-gray-500 border-0 flex justify-center ... focus:outline-none hover:bg-gray-600 rounded text-lg">{{ $buttonCheck }}</a>
                            <a href="{{ route('admin.shuhos.check',$shuho->id) }}" class="sm:hidden w-1/2 flex mx-auto my-1 text-white bg-gray-500 border-0 flex justify-center ... focus:outline-none hover:bg-gray-600 rounded text-lg">{{ $buttonCheck }}</a>
                            <a href="{{ route('admin.shuhos.comment', $shuho->id) }}" class="hidden w-1/4 sm:flex mx-auto my-1 text-white bg-gray-500 border-0 flex justify-center ... focus:outline-none hover:bg-gray-600 rounded text-lg">コメント</a>
                            <a href="{{ route('admin.shuhos.comment', $shuho->id) }}" class="sm:hidden w-1/2 flex mx-auto my-1 text-white bg-gray-500 border-0 flex justify-center ... focus:outline-none hover:bg-gray-600 rounded text-lg">コメント</a>
                            </div>
                        </div>
                        <a href="{{ route('admin.shuhos.index') }}" class="hidden sm:block text-blue-500">キャンセル</a>
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
