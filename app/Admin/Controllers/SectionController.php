<?php

namespace App\Admin\Controllers;

use App\Models\Section;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Section';


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Section());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'))->display(function (){
            return $this->localizedDetails()->name;
        });
        $grid->column('slug', __('Slug'));
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
        $show = new Show(Section::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Section());
        $id = request()->route()->parameter('section');
        if ($id){
            $model = Section::find($id);
            $form->sectionDetails = $model->allLocalizedDetails();
        }
        $form->tab(__('Information in '.app()->getLocale()), function($form){
            $details = isset($form->sectionDetails) ?$form->sectionDetails[app()->getLocale()] :['name'=>null, 'description' => null] ;
            $form->text('Name')->attribute(['name' => "locales[".app()->getLocale()."][name]", 'value' => $details['name']]);
            $form->text('Description')->attribute(['name' => "locales[".app()->getLocale()."][description]", 'value' => $details['description']]);
            $form->divider();
            $form->text('slug', __('Slug'));
            $form->text('parent', __('Parent section'));
            $form->text('status', __('Status'));
        });
        foreach (config('app.locales') as $locale){
            $form->locale = $locale;
            if ($locale == app()->getLocale()) continue;
            $form->tab(__($locale), function($form){
                $details = isset($form->sectionDetails) ?$form->sectionDetails[$form->locale] :['name'=>null, 'description' => null] ;

                $form->text('Name')->attribute(['name' => "locales[$form->locale][name]", 'value' => $details['name']]);
                $form->text('Description')->attribute(['name'=>"locales[$form->locale][description]",'value' => $details['description']]);

            });
        }

        $form->saved(function (Form $form) {
            foreach ($form->locales as $locale => $items){
                foreach ($form->locales[$locale] as $key => $value) {
                    $form->model()->details()->create([
                        'table' => 'sections',
                        'locale' => $locale,
                        'key' => $key,
                        'value' => $value
                    ]);
                }
            }
        });

        return $form;
    }
}
