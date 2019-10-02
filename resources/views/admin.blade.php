@extends('layouts.app')

@section('content')

<div class="container bg-light p-5 rounded" ng-app="myApp" ng-controller="myCtrl">


<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Inventory Management (Armory)
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse {{ (session()->get('curcollapse') == NULL ? 'show' : '') }}" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        Inventory

		<div class="row">
			<div class="col-sm">
				<form method="post" action="inventory" enctype="multipart/form-data">
				@csrf
				@method('post')
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Item Name</span>
					  </div>
					  <input type="text" name="name" class="form-control" placeholder="Item Name" aria-label="Username" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Item Info</span>
					  </div>
					  <input type="text" name="info" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect01">Category</label>
					  </div>
					  <select class="custom-select" name="category" id="inputGroupSelect01">
						<option value="0" selected>Choose...</option>
						@foreach ($cats as $c)
							<option value="{{$c->id}}">{{$c->name}}</option>
						@endforeach
					  </select>
					</div>
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text">Price</span>
					  </div>
					  <input type="text" name="price" class="form-control" aria-label="Amount (to the nearest dollar)">
					  <div class="input-group-append">
						<span class="input-group-text">Gold</span>
					  </div>
					</div>
					

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupFileAddon01">Item Image</span>
						</div>
						<div class="custom-file">
							<input type="file" name="picture" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
						</div>
					</div>
					<button class="btn btn-primary" type="submit" style="background-color:brown">Add Item</button>
				</form>
			</div>
			
			<div class="col-sm">
				

				<div class="row">
				  <div class="col-4">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					  @php $c = 0; @endphp
					  @foreach ($inventory as $i)
					  
						<a class="nav-link {{($c == 0 ? "active" : "") }}" 
						id="pill{{$c}}tab" data-toggle="pill" href="#pill{{$c}}" role="tab" aria-controls="pill{{$c}}" aria-selected="true">{{$i->name}}</a>
						@php $c++; @endphp
						@endforeach
					  @php $c = 0; @endphp
					</div>
				  </div>
				  <div class="col-8">
					<div class="tab-content" id="v-pills-tabContent">
					
					  @foreach ($inventory as $i)
					  
					  
					  <div class="tab-pane fade {{ ($c == 0 ? "show active" : "") }}" id="pill{{$c}}" role="tabpanel" aria-labelledby="pill{{$c}}tab">
					  <ul class="nav">
						<li class="nav-item p-1">
							<a ng-click="editInv({{$i->id}})" class="btn btn-warning nav-link" data-toggle="modal" data-target="#exampleModal" href="#">
								<i class="fas fa-edit"></i>
							</a>
						</li>
						<li class="nav-item p-1">
							<form action="inventory/{{$i->id}}" method="POST" id="item{{$i->id}}">
								@csrf
								@method('DELETE')
								<a class="btn btn-danger nav-link" onclick="document.getElementById('item{{$i->id}}').submit()" href="#"><i class="fas fa-trash-alt"></i></a>
							</form>
						</li>
					</ul>
						<img src="../storage/app/{{$i->picture}}" width="100px" style="float:right"/>
					  <h3>{{$i->name}}</h3>
					  <p class="lead">{{$i->category($i->category)->name}}</p>
					  {{$i->info}}
					  </div>
					  @php $c++; @endphp
					  
					  @endforeach
					</div>
				  </div>
				</div>	<hr />		
				{{ $inventory->appends(['sort' => 'name'])->links() }}
				
			</div>
		</div>
	 </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Category Management
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse {{ (session()->get('curcollapse') == "2" ? 'show' : '') }}" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
		@foreach ($cats as $c)
			<form method="post" action="category/{{$c->id}}" id="c{{$c->id}}">
				@csrf @method("DELETE")
				{{$c->name}} [<a href="#" onclick="document.getElementById('c{{$c->id}}').submit()" >&times;</a>]
			</form>
			<br />
		@endforeach
		<form method="POST" action="category">
		@csrf
			<div class="input-group mb-3">
			  <div class="input-group-prepend">
				<button class="btn btn-outline-secondary" type="submit" id="button-addon1">Add</button>
			  </div>
			  <input type="text" name="catname" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
			</div>
		
		</form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Patron Management
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
		@foreach ($users as $u)
		
			<li>{{$u->name}}</li>
		
		@endforeach
      </div>
    </div>
  </div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editing Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editInvModal">
	 
      </div>

    </div>
  </div>
</div>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {

  $scope.editInv = function (id) {
	$http.get("inventory/"+id+"/edit")
	.then(function(response) {
		document.getElementById("editInvModal").innerHTML = response.data;
	});
  }

});
</script> 


@endsection('content')
