<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户列表';

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        'index'  => ' ',
        'show'   => 'Show',
        'edit'   => 'Edit',
        'create' => 'Create',
    ];

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('admin.id'));
        $grid->column('name', __('admin.username'));
        $grid->column('email', __('admin.email'));
        $grid->column('email_verified_at', __('admin.email_verified_at'));
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('updated_at', __('admin.updated_at'));

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

        $show->field('id', __('admin.id'));
        $show->field('name', __('admin.userame'));
        $show->field('email', __('admin.email'));
        $show->field('email_verified_at', __('admin.email_verified_at'));
        $show->field('password', __('admin.password'));
        $show->field('remember_token', __('admin.token'));
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', __('admin.username'));
        $form->email('email', __('admin.email'));
        $form->datetime('email_verified_at', __('admin.email_verified_at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('admin.password'));
        $form->text('remember_token', __('admin.token'));

        return $form;
    }
}
