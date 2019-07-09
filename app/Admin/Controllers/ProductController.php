<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品列表';

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
        $grid = new Grid(new Product);

        $grid->column('id', __('admin.id'));
        $grid->column('title', __('admin.name'));
        $grid->column('on_sale', __('admin.on_sale'))->display(function ($value){
            return $value ? '是' : '否';
        });
        $grid->column('rating', __('admin.rating'));
        $grid->column('sold_count', __('admin.sold_count'));
        $grid->column('review_count', __('admin.review_count'));
        $grid->column('price', __('admin.price'));
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('updated_at', __('admin.updated_at'));

        // 关闭删除和查看功能
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

        // 关闭批量删除功能
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        // 查询过滤器
        $grid->filter(function($filter){
            // 在这里添加字段过滤器
            $filter->like('title', __('admin.name'));
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('admin.id'));
        $show->field('title', __('admin.name'));
        $show->field('description', __('admin.description'))->unescape();
        $show->field('image', __('admin.image'))->image();
        $show->field('on_sale', __('admin.on_sale'))->as(function ($on_sale){
            return $on_sale ? '是' : '否';
        });
        $show->field('rating', __('admin.rating'))->badge();
        $show->field('sold_count', __('admin.sold_count'))->badge('green');
        $show->field('review_count', __('admin.review_count'))->badge('red');
        $show->field('price', __('admin.price'));
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));
        $show->skus(__('admin.sku'), function ($skus){
            $skus->resource('/admin/products');
            $skus->title(__('admin.name'));
            $skus->introduction(__('admin.introduction'));
            $skus->price(__('admin.price'));
            $skus->stock(__('admin.stock'));

            $skus->disableFilter();
            $skus->disableCreateButton();
            $skus->disableExport();
            $skus->disableActions();
            $skus->disableRowSelector();
            $skus->disableColumnSelector();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('title', __('admin.name'))->rules('required');  # 商品名称
        $form->editor('description', __('admin.description'))->rules('required'); # 商品描述
        $form->image('image', __('admin.image'))->rules('required|image');  # 商品封面图
        $form->switch('on_sale', __('admin.on_sale'))->default(1);  # 是否上架

        // 商品 SKU ，一对多
        $form->hasMany('skus',  __('admin.sku'), function (Form\NestedForm $form) {
            $form->text('title', __('admin.name'))->rules('required');
            $form->text('introduction',  __('admin.introduction'))->rules('required');
            $form->text('price',  __('admin.price'))->rules('required|numeric|min:0.01');
            $form->number('stock',  __('admin.stock'))->default(0)->min(0)->rules('required|numeric|min:0');
        });

        //保存前回调
        $form->saving(function (Form $form) {
            // 当我们在前端移除一个 SKU 的之后，点击保存按钮时仍然会将被删除的 SKU 提交上去，但是会添加一个 _remove_=1 的字段，正常的 SKU 的 _remove_ 字段是 0
            $form->model()->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
        });


        return $form;
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
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->form()->store();
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $this->form()->update($id);
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }

}
