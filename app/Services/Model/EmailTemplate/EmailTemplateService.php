<?php

namespace App\Services\Model\EmailTemplate;

use App\Models\EmailTemplate;

class EmailTemplateService
{
    public function index():array
    {
        $data = [];
        $data['emailTemplates'] = $this->getTemplates();
        return $data;
    }
    public function getTemplates($conditions=[], $is_active = false)
    {
        return $this->initModel()->when($conditions, function($q) use($conditions){
            $q->where($conditions);
        })->when($is_active, function($q) use($is_active){
            $q->where('is_active', $is_active);
        })->get();
    }
    public function findById(int $id, $conditions=[], $is_active = false)
    {
        return $this->initModel()->where('id', $id)->when($conditions, function($q) use($conditions){
            $q->where($conditions);
        })->when($is_active, function($q) use($is_active){
            $q->where('is_active', $is_active);
        })->first();
    }
    public function update($request, $id)
    {
        $model = $this->findById($id);
        $model->subject = $request->subject;
        $model->code = $request->code;
        $model->is_active = $request->is_active ?? 0;
        $model->updated_by_id = user()->id;
        $model->save();
        return $model;
    }
    private function initModel()
    {
        return new EmailTemplate();
    }
}
