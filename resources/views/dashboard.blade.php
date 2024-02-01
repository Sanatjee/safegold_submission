<x-app-layout>
    {{-- CSRF token for ajax request --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSRF token for ajax request --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- alerts starts here --}}
    @include('partials.session_alerts')
    {{-- alerts ends here --}}

    {{-- plans starts here --}}
    @if($user->subscriptions->last()->id != config('site.ELITE_PLAN_ID'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center ">
                @foreach($plans as $plan)
                    @if(
                        $plan->id != config('site.DEFAULT_PLAN_ID') && 
                        $user->subscriptions->last()->id != $plan->id 
                    )
                        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="margin-left: 50px; margin-right:50px">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$plan->plan}}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$plan->description}}</p>
                            <form method="POST" action="{{route('subscriptions.store')}}">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}" />
                                <button type="submit" class="inline-flex text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Upgrade
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- plans ends here --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="creatUrlForm" method="POST">
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Upload URL</h2>
                        
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="original_url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                                        <div class="mt-2">
                                            <input type="text" name="original_url" id="original_url"  class="block w-full rounded-md border-0 py-1.5  text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <div class="error-message"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
                        </div>
                
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit"  class="rounded-md  px-4  bg-green-100 px-3 py-2 text-sm font-semibold text-green-800  shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    @include('partials.delete_modal')
    
    
    {{-- Url Listing starts here --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto" style="width:100%">
                        <thead>
                            <tr>
                                <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                #</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Original Url</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Short URL</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Actions</th>
                                
                            </tr>
                        </thead>
        
                        <tbody class="bg-white">
                            @forelse ($urls as $key => $url)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">{{ $key + 1 }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="{{ $url->original_url }}" target="_blank">
                                        {{ $url->original_url }}
                                        </a>
                                </td>
                                
        
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        <a href="{{app('url')->to('/') .'/'.$url->short_url}}" target="_blank">
                                            {{app('url')->to('/') .'/'.$url->short_url}}
                                        </a>
                                    </div>
                                </td>
        
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    @if($url->status == 'active')
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                                    @else
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Inactive</span>
                                    @endif
                                </td>
        
                                <td
                                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <a class="trashEntity"
                                        href="{{ route('urls.edit',['url' => $url->id]) }}"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        
                                        <a class="trashEntity"
                                                data-id = "{{$url->id}}"
                                                data-url = "{{route('urls.destroy',['url' => $url->id ])}}"
                                        >
                                            <svg 
                                                data-modal-target="popup-modal" 
                                                data-modal-toggle="popup-modal" 
                                                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                
                                                
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                
                            </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">No URLs found</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $urls->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- Url Listing ends here --}}

    

@section('page-js')
<script>   
$('document').ready(function(){
    $('#creatUrlForm').submit((e) => {
        e.preventDefault();
        let original_url = $('#original_url').val();
        if(original_url.length <= 0){
            addError('This field is required');
            return
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var saveData = $.ajax({
            type: "POST",
            url: "{{ route('urls.store') }}",
            data: {original_url},
            dataType: "json",
            success: function(resultData){
                location.reload();
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR.responseJSON.message)
                addError(jqXHR.responseJSON.message)
            }
        });
        console.log(original_name)
    })

    function addError(error){
        $('.error-message').html('<p class="text-red-800 font-bold">'+error+'</p>');
        removeError();
    }

    function removeError(){
        setTimeout(function () {
                $('.error-message').html('');
        }, 3000);
    }

    $(document).on('click', '.trashEntity', function(event) {
        console.log("clicked")
        var entityId = $(this).attr('data-id');
        var entityUrl = $(this).attr('data-url');
        console.log(entityId);
        $('#entity_id').val(entityId);
        $('#trashEntityForm').attr('action', entityUrl);
    }); 
});
</script>
@endsection

</x-app-layout>


