<?php

namespace App\Http\Repositories;

use App\Models\Url;

class UrlRepository
{
    public function create(array $data)
    {
        return Url::create($data);
    }

    public function update(array $data)
    {   
        $url = Url::findOrFail($data['id']);
        return $url->update($data);
    }

    public function findById($id)
    {   
        $url = Url::findOrFail($id);
        return $url;
    }

    public function delete($id)
    {
        $url = Url::findOrFail($id);

        return $url->delete();
    }

}