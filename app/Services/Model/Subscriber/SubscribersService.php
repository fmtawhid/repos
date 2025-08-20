<?php

namespace App\Services\Model\Subscriber;

use App\Models\SubscribedUser;


class SubscribersService
{
    public function index($search = null)
    {
        $searchKey = null;
        $subscribers = SubscribedUser::latest();
        if ($search != null) {
            $subscribers = $subscribers->where('email', 'like', '%' . $search . '%');
            $data['searchKey'] = $search;
        }
        $data['subscribers'] = $subscribers->paginate(maxPaginateNo());

        return $data;
    }
    # delete subscribers
    public function delete($id)
    {
        SubscribedUser::destroy($id);
        return back();
    }
}
