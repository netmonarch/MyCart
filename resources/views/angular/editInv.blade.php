<form method="post" action="inventory/{{$inv->id}}" enctype="multipart/form-data">
				@csrf
				@method('patch')
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Item Name</span>
					  </div>
					  <input type="text" name="name" class="form-control" value="{{$inv->name}}" aria-label="Username" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Item Info</span>
					  </div>
					  <input type="text" name="info" class="form-control" value="{{$inv->info}}" aria-label="Description" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect01">Category</label>
					  </div>
					  <select class="custom-select" name="category" id="inputGroupSelect01">
						<option value="0" selected>Choose...</option>
						@foreach ($cats as $c)
							<option value="{{$c->id}}" @if ($c->id == $inv->category) selected @endif>{{$c->name}}</option>
						@endforeach
					  </select>
					</div>
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text">Price</span>
					  </div>
					  <input type="text" name="price" class="form-control" value="{{$inv->price}}" aria-label="Amount (to the nearest dollar)">
					  <div class="input-group-append">
						<span class="input-group-text">Gold</span>
					  </div>
					</div>
					
					<img src="../storage/app/{{$inv->picture}}" width="100px" alt="no image" />
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupFileAddon01">Item Image</span>
						</div>
						<div class="custom-file">
							
							
							<input type="file" name="picture" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
						</div>
					</div>
					<div class="modal-footer">
       					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      					  <button type="submit" class="btn btn-primary">Save changes</button>
     				 </div>
				</form>