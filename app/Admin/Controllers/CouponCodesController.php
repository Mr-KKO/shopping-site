<?php

namespace App\Admin\Controllers;

use App\Models\CouponCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CouponCodesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '优惠券列表';

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
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CouponCode);

        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('id', __('admin.id'));
        $grid->column('name', __('admin.name'));
        $grid->column('code', __('admin.coupon_code'));
        $grid->column('description', __('admin.description'));
        $grid->column('usage', __('admin.usage'))->display(function ($value){
            return "{$this->used} / {$this->total}";
        });
        $grid->column('min_amount', __('admin.min_amount'));
        $grid->column('enabled', __('admin.enabled'))->display(function ($value){
            return $value ? '是' : '否';
        });
        $grid->column('created_at', __('admin.created_at'));

        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $show = new Show(CouponCode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('code', __('Code'));
        $show->field('type', __('Type'));
        $show->field('value', __('Value'));
        $show->field('total', __('Total'));
        $show->field('used', __('Used'));
        $show->field('min_amount', __('Min amount'));
        $show->field('not_before', __('Not before'));
        $show->field('not_after', __('Not after'));
        $show->field('enabled', __('Enabled'));
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
        $form = new Form(new CouponCode);

        $form->display('id', __('admin.id'));
        $form->text('name', __('admin.name'))->rules('required');
        $form->text('code', __('admin.coupon_code'))->rules(function ($form){
            // 如果 $form->model()->id 不为空，代表是编辑操作
            if ($id = $form->model()->id){
                return 'nullable|unique:coupon_codes,code,'.$id.',id';
            }else{
                return 'nullable|unique:coupon_codes';
            }
        });
        $form->radio('type', __('admin.type'))->options(CouponCode::$typeMap)->rules('required')->default(CouponCode::TYPE_FIXED);
        $form->text('value', __('admin.discount_or_amount'))->rules(function ($form){
            if ($form->model()->type === CouponCode::TYPE_PERCENT){
                // 如果选择了百分比折扣类型，那么折扣范围只能是 1 ~ 99
                return 'required|numeric|between:1,99';
            }else{
                // 否则只要大等于 0.01 即可
                return 'required|numeric|min:0.01';
            }
        });
        $form->number('total', __('admin.total'))->rules('required|numeric|min:0');
        $form->decimal('min_amount', __('admin.min_amount'))->rules('required|numeric|min:0');
        $form->datetime('not_before', __('admin.start_time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('not_after', __('admin.end_time'))->default(date('Y-m-d H:i:s'));
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('enabled', __('admin.enabled'))->states($states)->default(1);

        $form->saving(function (Form $form){
            if (!$form->code){
                $form->code = CouponCode::findAvailableCode();
            }
        });

        return $form;
    }
}
