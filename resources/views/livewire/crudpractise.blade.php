<div>
    <div class="col-md-12 my-2">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif

                {{-- @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
            @endif --}}

            <form >
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" wire:model="name" placeholder="Enter your name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" wire:model="description" placeholder="enter the description">
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="d-grip gap-2">
                    <button wire:click.prevent ="store()" class="btn btn-success btn-block">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <br>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                                <td colspan="2">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $post)
                                <tr>
                                    <td>{{ $post['name'] }}</td>
                                    <td>{{ $post['description'] }}</td>
                                    <td><button  type="button" wire:click="$emitSelf('edit', {{ $post['id'] }})"  class="editBtn btn btn-secondary" >Edit</button></td>
                                    <td><button  type="button" wire:click="$emitSelf('deleteConfirmation', {{ $post['id'] }})"  class=" btn btn-danger" >Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
  <!-- Modal -->
  <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9099 !important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Editing</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form wire:submit.prevent="savechanges">
            <div class="form-group mb-2">
                <label for="name">Name :</label>
                <input type="text" class="form-control" name="name" id="name" value="" placeholder="enter your name" wire:model="name2">
            </div>
            <div class="form-group mb-2">
                <label for="description">Description :</label>
                <textarea name="description" class="form-control" id="description" value="" cols="20" rows="3" placeholder="enter the description" wire:model="description2"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9099 !important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Deleting</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <h5>Are you sure you want to delete?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    // window.addEventListener('close-modal', event=>{
    //     $("#editModal").modal('hide');
    // });

    window.addEventListener('show-edit-modal', (data)=>{
        $('#editModal').modal('show');
        
    });
    window.addEventListener('hide-edit-modal', (data) => {
        $('#editModal').modal('hide');
    });

    window.addEventListener('show-delete-modal', (data)=>{
        $('#deleteModal').modal('show');
        
    });

    
</script>

</div>
