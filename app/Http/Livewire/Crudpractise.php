<?php

namespace App\Http\Livewire;

use App\Models\Post;

use Illuminate\Contracts\Session\Session;
use Livewire\Component;

class Crudpractise extends Component
{
    public $name, $description,$name2,$description2, $deleteId, $postId;

    protected $listeners = ['edit','delete'];

    public function render()
    {
        $post = Post::all();
        return view('livewire.crudpractise',compact('post'));
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Post::create([
            'name'=> $this->name,
            'description' => $this->description
        ]);

        session()->flash('success','successfully added');

        $this->resetFields();

    }

    public function resetFields(){
        $this->name = '';
        $this->description = '';
    }

   public function edit($id){

    $post = Post::where('id',$id)->first();
    $this->name2 = $post->name;
    $this->description2 = $post->description;
    $this->dispatchBrowserEvent('show-edit-modal');
   }

//    public function edit($postId)
//    {
//        $post = Post::findOrFail($postId);
//        $this->postId = $post->id;
//        $this->name2 = $post->name;
//        $this->description2 = $post->description;

//        $this->emit('show-edit-modal');
//    }

   public function saveChanges()
   {
       $post = Post::findOrFail($this->postId);
       $post->name = $this->name2;
       $post->description = $this->description2;
       $post->save();

       $this->emit('dataSaved', 'editModal');
       $this->emit('hide-edit-modal');
   }

//    public function savechanges($id){
//     $this->validate([
//         'name'=> 'required',
//         'description' => 'required'
//     ]);

//     $post = Post::where('id',$id)->first();
//     $post->name = $this->name2;
//     $post->description = $this->description2;
//     $post->update();

//     session()->flash('success','successfully updated');

//    }

   public function deleteConfirmation($id){
    $this->deleteId = $id;
    $this->dispatchBrowserEvent('show-delete-modal');
   }

   public function delete(){
    $data = Post::where('id',$this->deleteId)->first();
    $data->delete();

    session()->flash('session','successfully deleted');
   }
}

