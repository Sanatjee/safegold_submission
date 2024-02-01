<x-app-layout>
    {{-- CSRF token for ajax request --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSRF token for ajax request --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update URL') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="creatUrlForm" method="POST" action="{{ route('urls.update',['url' => $url->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Update URL</h2>
                        
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="original_url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                                        <div class="mt-2">
                                            <input type="text" name="original_url" id="original_url" value="{{ $url->original_url }}"  
                                            class="block w-full rounded-md border-0 py-1.5  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="active" @if($url->status == "active") selected="selected" @endif>Active</option>
                                            <option value="inactive" @if($url->status == "inactive") selected="selected" @endif>Inactive</option>
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="error-message">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-red-800 font-bold">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div> 
                        </div>
                
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit"  class="rounded-md  px-4  bg-green-100 px-3 py-2 text-sm font-semibold text-green-800  shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>


    

@section('page-js')

@endsection

</x-app-layout>


