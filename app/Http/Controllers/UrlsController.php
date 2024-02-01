<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;


use App\Http\Services\UrlService;
use App\Models\Url;

class UrlsController extends Controller
{
    protected $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    

    public function store(StoreUrlRequest $request)
    {   
        $validatedData = $request->validated();

        return $this->urlService->storeUrl($validatedData['original_url']);
    }

    
    public function edit($id)
    {   
        $url = Url::findOrFail($id);
        return view('urls.edit')->with(compact('url'));
    }

    
    public function update(UpdateUrlRequest $request, $id)
    {
        
        $validatedData = $request->validated();

        $data = [
            "original_url" => $validatedData['original_url'],
            "status" => $validatedData['status'],
        ];

        $update = $this->urlService->updateUrl($data,$id);

        if(!$update){
            return redirect()->back()->with('error',config('webresponse.generic_error'));
        }
        return redirect()->route('dashboard')->with('success',config('webresponse.update_success'));
    }

    
    public function destroy($id)
    {
        $delete = $this->urlService->deleteUrl($id);

        if(!$delete){
            return redirect()->back()->with('error',config('webresponse.generic_error'));
        }

        return redirect()->back()->with('success',config('webresponse.delete_success'));
    }
}
