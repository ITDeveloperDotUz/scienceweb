<?php

namespace App\Admin\Actions\Publication;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BatchPublish extends BatchAction
{
    public $name = 'Publish/Unpublish';

    public function handle(Collection $collection)
    {
        foreach ($collection as $model) {
            if($model->status == 0){
                $model->update(['status' => 1]);
            } else {
                $model->update(['status' => 0]);
            }

        }

        return $this->response()->success('Success message...')->refresh();
    }

}
