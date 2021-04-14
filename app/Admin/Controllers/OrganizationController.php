<?php

namespace App\Admin\Controllers;

use App\Models\Organization;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrganizationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Organization';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Organization());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Name');
        $grid->column('abbrev', 'Abbreviation');
        $grid->column('country_id', 'Country');
        $grid->column('user_id', 'Owner');
        $grid->column('website', 'Website');
        $grid->column('created_at', trans('admin.created_at'));
        $grid->column('updated_at', trans('admin.updated_at'));
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDelete();
            }
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
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
        $show = new Show(Organization::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Organization());


        $form->display('id', 'ID');

        $form->text('name', trans('admin.name'))->rules('required');
        $form->text('abbrev', trans('Abbreviation'))->rules('required');
        $form->text('website', trans('Website'))->rules('required');
        $form->image('logo', trans('Logo'));
        $form->number('country_id', trans('Country'));

        $form->textarea('description', trans('Description'));

        // contact model
        $form->divider();

        $form->text('contact.username', 'Contact User Name');
        $form->text('contact.title', 'Contact owner organization');
        $form->email('contact.email', 'Email');
        $form->text('contact.phone', 'Phone');
        $form->text('contact.address_1', 'Address 1');
        $form->text('contact.address_2', 'Address 2');


        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }

    public function index(Content $content): Content
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }
}

