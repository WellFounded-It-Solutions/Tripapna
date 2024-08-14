@extends('layouts.admin_design')
@section('content')
<div class="content-wrapper pl3">

<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Sales Executive</h1>
                </div>
         </div>
      </div>
   </section>
   <section class="content">
   <div class="row">
    <div class="col-md-8">
    <form action="{{ route('sales_executives.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div class="form-group">
        <div>
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password">
       </div>
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>
        <div class="form-group">
            <label>ID Proof</label>
            <input type="text" name="id_proof" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</div>
</section>
</div>
@endsection

