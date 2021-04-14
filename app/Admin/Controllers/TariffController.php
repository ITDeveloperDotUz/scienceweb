<?php

namespace App\Admin\Controllers;

use App\Models\Tariff;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TariffController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tariff';


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tariff());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('amount', __('Amount'));
        $grid->column('period', __('Period'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Tariff::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('amount', __('Amount'));
        $show->field('period', __('Period'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Tariff());

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->textarea('description', __('Description'));
        $form->date('expiration', __('Expiration'));
        $form->number('amount', __('Amount'));
        $form->select('period', __('Period'))->options([1 => 'daily', 2 => 'weekly', 3 => 'monthly', 4 => 'yearly']);
        $form->select('status', __('Status'))->options([0 => 'Inactive', 1 => 'Active']);


        return $form;
    }
}
