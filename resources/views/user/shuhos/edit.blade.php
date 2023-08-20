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
                    <section class="text-gray-600 body-font relative">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="post" action="{{ route('user.shuhos.update', $shuho->id) }}">
                        @csrf
                        @method('PUT')
                    <div class="container px-5 mx-auto">
                        <div class="flex flex-col text-center w-full mb-12">
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">編集画面</p>
                        </div>
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <div class="flex flex-wrap -m-2">

                            <!-- Name(報告者名) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
                                <input type="text" id="name" name="name" value="{{ $shuho->name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            </div>

                            <!-- Level(順調度合) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                <label for="level" class="leading-7 text-sm text-gray-600">順調度合い</label><br>
                                <input type="radio" name="level" value="good" @if($shuho->level == 'good') checked  @endif>順調
                                <input type="radio" name="level" value="normal" @if($shuho->level == 'normal') checked @endif>やや問題あり
                                <input type="radio" name="level" value="bad" @if($shuho->level == 'bad') checked @endif>問題あり
                            </div>
                            </div>

                            <!-- Report(報告内容) -->
                            <div class="p-2 w-full">
                            <div class="relative">
                                <label for="report" class="leading-7 text-sm text-gray-600">報告内容</label>
                                <textarea id="report" name="report" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $shuho->report }}</textarea>
                            </div>

                            <!-- button(登録ボタン) -->
                            </div>
                            <div class="p-2 w-full">
                            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                            </div>

                        </div>
                        </div>
                    </div>
                    </form>
                    </section>
                    <a href="{{ route('user.shuhos.show', $shuho->id) }}" class="text-blue-500">キャンセル</a>
                </div>
            </div>
        </div>
    </div>
    <div class="index_footer sm:hidden flex bg-gray-100 w-full my-auto border border-gray-300">
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('user.shuhos.index') }}"><img src="{{ asset('storage/images/普通の家のアイコン.png') }}" class="flex justify-center"></a></div>
        <div class="w-1/6 mx-auto my-0 border border-gray-100 p-4"><a href="{{ route('user.shuhos.create') }}"><img src="{{ asset('storage/images/紙とペンのアイコン素材.png') }}" class="flex justify-center"></a></div>
    </div>
</x-app-layout>
