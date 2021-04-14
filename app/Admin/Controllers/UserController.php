<?php

namespace App\Admin\Controllers;

use App\Models\Country;
use App\Models\Tariff;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('middle_name', __('Middle name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('roles', __('Role'))->display(function ($roles){
            $names = [];
            foreach ($roles as $role) {
                $names[] = $role['name'];
            }
            return $names;
        })->label();
        $grid->column(__('Tariff'))->display(function (){
            if (count($this->tariff) > 0)
                return $this->tariff[0]->name;
            return null;
        });
        $grid->column('created_at', __('Created at'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('middle_name', __('Middle name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('role', __('Role'));
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('first_name', __('First name'))->required();
        $form->text('last_name', __('Last name'))->required();
        $form->text('middle_name', __('Middle name'));
        $form->text('phone', __('Phone'))->required()->creationRules(['required', "unique:users"]);
        $form->email('email', __('Email'))->required()->creationRules(['required', "unique:users"]);
        $form->multipleSelect('roles', __('Roles'))->options(Role::all()->pluck('name', 'id'))->required();
        $form->multipleSelect('tariff', __('Tariff'))->options(function (){
            $tariffs = Tariff::all();
            $tariffsList = [];
            foreach ($tariffs as $tariff) {
                $tariffsList[$tariff->id] = $tariff->name;
            }
            return $tariffsList;
        })->required();
        $form->select('country_code', __('Country'))->options(function (){
            $countriesList = Country::all();
            $countries = [];
            foreach ($countriesList as $country) {
                $countries[$country->iso2] = $country->name;
            }
            return $countries;
        })->required();
        $form->text('state', __('State'))->required();
        $form->text('profile.address_1', __('Address 1'));
        $form->text('profile.address_2', __('Address 2'));


        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        return $form;
    }
}
