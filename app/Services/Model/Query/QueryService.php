<?php


namespace App\Services\Model\Query;

use App\Models\ContactUsMessage;

class QueryService 
{

    public function getAll(
        $isPaginateGetOrPluck = null
    )  {

        $query = ContactUsMessage::query()->orderBy('is_seen', 'ASC');
        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function read($id)
    {
        $message = $this->findById($id);

        if ($message->is_seen == 0) {
            $message->is_seen = 1;          
        } else {
            $message->is_seen = 0;          
        }
        $message->save();
    }

    public function edit(int $id)
    {
        return $this->findById($id);
    }

    public function update(object $language, array $payloads)
    {
        $language->update($payloads);

        return $language;
    }
    public function findById($id, $withRelationships = [], $conditions = [])
    {
        $query = ContactUsMessage::query();
        
        // condition search
        if(!empty($conditions)) {
            $query->where($conditions);
        }
        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }
    public function delete($id, $force = null)
    {
        $message = $this->findById($id); 
        if(!is_null($message)){
            if ($force != null) {
                $message->forceDelete();
            }else{
                $message->delete();
            }
            return true;
        }
        return false;

    }
    public function deleteAll()
    {
        ContactUsMessage::whereNotNull('id')->forceDelete(); 
    }
    
}