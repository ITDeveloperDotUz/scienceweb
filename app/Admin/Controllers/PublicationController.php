<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Publication\BatchPublish;
use App\Models\Submission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PublicationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Submission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Submission());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('section_id', __('Section id'));
        $grid->column('category_id', __('Category id'));
//        $grid->column('doi', __('Doi'));
        $grid->column('status', __('Status'))->display(function ($status){
            switch ($status){
                case 0:
                    $result = "Unpublished";
                    break;
                case 1:
                    $result = "Published";
                    break;
                default:
                    $result = 'Unpublished';
            }
            return $result;
        })->label([0 => 'danger', 1 => 'success']);
        $grid->column('locale', __('Locale'));
//        $grid->column('citations', __('Citations'));
//        $grid->column('file', __('File'));
//        $grid->column('preview', __('Preview'));
//        $grid->column('thumb', __('Thumb'));
        $grid->column('rights', __('Rights'));
//        $grid->column('published_at', __('Published at'));
//        $grid->column('issued_at', __('Issued at'));
        $grid->column('submitted_at', __('Submitted at'));
//        $grid->column('deleted_at', __('Deleted at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        $grid->batchActions(function ($batch) {
            $batch->add(new BatchPublish());
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Submission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('section_id', __('Section id'));
        $show->field('category_id', __('Category id'));
        $show->field('doi', __('Doi'));
        $show->field('status', __('Status'));
        $show->field('locale', __('Locale'));
        $show->field('citations', __('Citations'));
        $show->field('file', __('File'));
        $show->field('preview', __('Preview'));
        $show->field('thumb', __('Thumb'));
        $show->field('rights', __('Rights'));
        $show->field('published_at', __('Published at'));
        $show->field('issued_at', __('Issued at'));
        $show->field('submitted_at', __('Submitted at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Submission());

        $form->number('user_id', __('User id'));
        $form->number('section_id', __('Section id'));
        $form->number('category_id', __('Category id'));
        $form->text('doi', __('Doi'));
        $form->number('status', __('Status'))->default(1);
        $form->text('locale', __('Locale'));
        $form->textarea('citations', __('Citations'));
        $form->file('file', __('File'));
        $form->text('preview', __('Preview'));
        $form->text('thumb', __('Thumb'));
        $form->text('rights', __('Rights'));
        $form->datetime('published_at', __('Published at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('issued_at', __('Issued at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('submitted_at', __('Submitted at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}

