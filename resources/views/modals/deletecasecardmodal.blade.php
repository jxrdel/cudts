<!-- Modal -->
<div class="modal fade modal-sm" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel" style="color:red;margin:auto">Warning <i class="bi bi-exclamation-triangle"></i></h1>
        </div>
        <div class="modal-body">
          {{-- Form to create daily register --}}
            <form method="POST" id="createDailyRegister" action="#">
                @csrf
                @method('PUT')
                <div class="mb-3" style="text-align:center">
				  <p>This batch was created by <strong>To</strong>. <br></p>
				  <p>Press 'Continue' to proceed or 'Cancel' to return to the Batches page</p>
                </div>
                <div class="row" style="display: flex">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="margin:auto">Continue</button>
                    </div>

                    <div class="col" style="text-align: end">
                        <a href="#"><button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" style="margin:auto; width:90px">Cancel</button></a>
                    </div>

                </div>
              </form>
        </div>
      </div>
    </div>
    </div>