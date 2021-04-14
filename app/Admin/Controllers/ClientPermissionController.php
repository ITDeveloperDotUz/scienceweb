<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClientPermissionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */

    protected $title = 'Permission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Permission());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('guard_name', __('Guard'));

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
        $show = new Show(Permission::findOrFail($id));

        $show->field('name', __('Name'));
        $show->field('guard_name', __('Guard'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Permission());

        $form->text('name', __('Name'));
        $form->text('guard_name', __('Guard'));
        $form->multipleSelect('roles','Role')->options(Role::all()->pluck('name','id'));

        return $form;
    }
}
