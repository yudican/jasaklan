<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog;
use Livewire\Component;


class BlogController extends Component
{

    public $blog_id;
    public $body;
    public $title;

    public $route_name = null;

    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataBlogById', 'getBlogId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.blog')->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'body'  => $this->body,
            'title'  => $this->title
        ];

        Blog::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'body'  => $this->body,
            'title'  => $this->title
        ];
        $row = Blog::find($this->blog_id);

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Blog::find($this->blog_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'body'  => 'required',
            'title'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataBlogById($blog_id)
    {
        $this->_reset();
        $row = Blog::find($blog_id);
        $this->blog_id = $row->id;
        $this->body = $row->body;
        $this->title = $row->title;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getBlogId($blog_id)
    {
        $row = Blog::find($blog_id);
        $this->blog_id = $row->id;
    }

    public function toggleForm($form)
    {
        $this->_reset();
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->_reset();
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->blog_id = null;
        $this->body = null;
        $this->title = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
