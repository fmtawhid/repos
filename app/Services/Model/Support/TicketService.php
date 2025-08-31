<?php

namespace App\Services\Model\Support;

use App\Models\Ticket;
use App\Models\TicketFile;
use App\Traits\File\FileUploadTrait;

class TicketService
{

    use FileUploadTrait;
    // public function getAll(
    //     $isPaginateGetOrPluck = null,
    //     $onlyActives = null,
    //     $withRelationships = ["updatedBy", "createdBy"])
    // {

    //     $query = Ticket::query()->filters()->orderBy('id', 'DESC');

    //     // Bind Relationships
    //     (!empty($withRelationships) ? $query->with($withRelationships) : false);

    //     if(!is_null($onlyActives)){
    //         $query->isActive($onlyActives);
    //     }

    //     if (is_null($isPaginateGetOrPluck)) {
    //         return $query->pluck("name", "id");
    //     }

    //     return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    // }
    // App\Services\Model\Support\TicketService.php
    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"],
        $forVendor = false
    ) {
        $query = Ticket::query()->filters()->orderBy('id', 'DESC');

        // ভেন্ডারের জন্য শুধুমাত্র নিজের তৈরি টিকেট দেখাবে
        if ($forVendor) {
            $query->forVendor();
        }

        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function index($forVendor = false): array
    {
        $data = [];
        $data['tickets'] = $this->getAll(true, null, ["updatedBy", "createdBy"], $forVendor);
        $data['categories'] = (new CategoryService())->getAll(true, true);
        $data['priorities'] = (new PriorityService())->getAll(null, true);
        return $data;
    }
    
    public function findTicketById($id, $withRelationships = [], $conditions = [])
    {
        $query = Ticket::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        $ticket = Ticket::query()->create($payloads);

        // Ticket Files Store
        if (!empty($payloads['files'])) {
            foreach ($payloads["files"] as $key=>$ticketFile){

               $filePath = $this->uploadFile($ticketFile, fileService()::DIR_TICKET);

               TicketFile::query()->create([
                   'ticket_id' => $ticket->id,
                   'file_path' => $filePath,
                   "is_active" => 1
               ]);
            }
        }

        return $ticket;
    }

    public function update(object $ticket, array $payloads)
    {
        $ticket->update($payloads);

        return $ticket;
    }
    // public function index():array
    // {
    //     $data = [];
    //     $data['tickets'] = $this->getAll(true, null);
    //     $data['categories'] = (new CategoryService())->getAll(true, true);
    //     $data['priorities'] = (new PriorityService())->getAll(null, true);
    //     return $data;
    // }

}

