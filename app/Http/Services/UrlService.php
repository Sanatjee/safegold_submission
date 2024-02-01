<?php

namespace App\Http\Services;
use App\Http\Repositories\UrlRepository;
use Illuminate\Support\Facades\Auth;

class UrlService
{   
    protected $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function storeUrl($originalUrl)
    {
        $user = Auth::user();

        $allowed_urls = json_decode($user->subscriptions->last()->config);
        if(!$allowed_urls){
            return response()->json(['message' => config('webresponse.generic_error')],500);
        }

        // get users uploaded 
        $current_url_count = $user->urls->count();

        if( $current_url_count >= $allowed_urls->allowed_url_upload ){
            return response()->json(['message' => config('webresponse.quota_error')],403);
        }
        
        $shortCode = $this->generateShortCode();

        $data = [
            "user_id" => $user->id,
            "original_url" => $originalUrl,
            "short_url" => $shortCode,
        ];

        $store = $this->urlRepository->create($data);

        return $store;
    }

    public function updateUrl($data,$id)
    {
        $url = $this->urlRepository->findById($id);
        
        if(!$this->checkOwner($url)){
            return abort(403);
        }

        $shortCode = $this->generateShortCode();

        $data = [
            "id" => $id,
            "original_url" => $data['original_url'],
            "short_url" => $shortCode,
            "status" => $data['status'],
        ];

        $update = $this->urlRepository->update($data);

        return $update;
    }

    public function deleteUrl($id){
        return $this->urlRepository->delete($id);
    }

    private function generateShortCode()
    {
        $timestamp = now()->timestamp;
        $randomString = $this->generateRandomString(5);
        $combinedString = $timestamp . $randomString;

        $hashedString = hash('sha256', $combinedString);
        $shortCode = substr($hashedString, 0, 20);

        return $shortCode;
    }

    private function generateRandomString($length)
    {
        // Generate a random string with the specified length
        $characters = config('url.URL_CHARS');
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    private function checkOwner($urlData){
        $user = Auth::user();
        return $urlData->user_id == $user->id;
    }

    
    
}